<?php

namespace App\Http\Controllers\Admin;

// 以下を追加
use App\Http\Controllers\Controller;
use App\Services\FileService;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategorysFlont;
use App\Models\ProductCategory;
use Validator;
use DB;

class ProductController extends Controller
{
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index()
    {
        $pagination = Product::with('add_category')->paginate(20);
        $data = [
            'pagination' => $pagination,
        ];
        return view('admin.product.index', $data);
    }

    public function create()
    {
        return view('admin.product.edit');
    }

    public function create_exe(Request $request, Product $Product)
    {
        DB::transaction(function () use ($request, $Product) {
            if ($request->file('file_data') !== null) {
                $fileName = $this->fileService->addFile($request->file('file_data'));
                $request->merge([
                    'file_name' => $fileName,
                ]);
            }
            $Product->fill($request->all())->save();
            $last_insert_id = $Product->id;
            ProductCategory::InsertRel($request->category, $last_insert_id);
            $this->CategorysFlontSet();
        });
        return redirect('admin/product/edit/' . $last_insert_id)->with('one_time_mes', 1);
    }

    public function update($id)
    {
        $detail = Product::with('add_category')->StatusCheck()->find($id);
        if (empty($detail)) {
            abort('404');
        }
        $data = [
            'detail' => $detail,
            'select_category' => $detail->add_category->pluck('id')->toArray()
        ];
        return view('admin.product.edit', $data);
    }

    public function update_exe(Request $request)
    {
        DB::transaction(function () use ($request) {
            if ($request->file('file_data') !== null) {
                $this->fileService->removeFile($request->id);
                $fileName = $this->fileService->addFile($request->file('file_data'));
                $request->merge([
                    'file_name' => $fileName,
                ]);
            }
            $q = Product::findOrFail($request->id);
            $q->fill($request->all())->save();
            ProductCategory::where('product_id', '=', $request->id)
                ->delete();
            ProductCategory::InsertRel($request->category, $request->id);
            $this->CategorysFlontSet();
        });
        return redirect('admin/product/edit/' . $request->id)->with('one_time_mes', 2);
    }

    public function CategorysFlontSet(): void
    {
        $results = Category::select('categorys.id', 'categorys.title', 'categorys.text')
            ->leftJoin('product_category', 'product_category.category_id', '=', 'categorys.id')
            ->leftJoin('products', 'products.id', '=', 'product_category.product_id')
            ->where('products.status', config('const.STATUS_ON'))
            ->groupBy('categorys.id')
            ->orderBy('categorys.id', 'asc')
            ->get()
            ->toArray();
        CategorysFlont::truncate();
        CategorysFlont::insert($results);
    }

    public function checkbox(Request $request)
    {
        if ($request->mode == 1) {
            $this->on($request);
        }
        if ($request->mode == 2) {
            $this->off($request);
        }
        if ($request->mode == 3) {
            $this->delete($request);
        }
        return json_encode(['success' => true]);
    }

    public function on($request)
    {
        Product::whereIn('id', $request->vals)->update(['status' => config('const.STATUS_ON')]);
    }

    public function off($request)
    {
        Product::whereIn('id', $request->vals)->update(['status' => config('const.STATUS_OFF')]);
    }

    public function delete($request)
    {
        Product::destroy($request->vals);
    }

    public function val(Request $request)
    {
        $array = [
            'title'  => 'required',
            'text' => 'required',
            'category'  => 'required',
            'price'  => ['required', 'integer'],
            'num' => ['required', 'integer'],
            'file_data' => [
                'required',
                'mimes:jpeg,bmp,png',
                'dimensions:min_width=100,min_height=200'
            ],
        ];
        if (!empty($request->file_name) && empty($request->file_data)) {
            unset($array['file_data']);
        }
        $validator = Validator::make($request->all(), $array);
        if ($validator->fails()) {
            return json_encode(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
        } else {
            return json_encode(['success' => true]);
        }
    }
}
