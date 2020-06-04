<?php

namespace App\Http\Controllers\Admin;

// 以下を追加
use App\Http\Controllers\Controller;
use App\Services\Admin\FileService;
use App\Services\Admin\ProductService;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;
use App\Models\Product;
use Validator;
use DB;

class ProductController extends Controller
{
    private $fileService;
    private $productService;
    private $categoryService;

    public function __construct(
        FileService $fileService,
        ProductService $productService,
        CategoryService $categoryService
    ) {
        $this->fileService = $fileService;
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $pagination = $this->productService->list();
        $data = [
            'pagination' => $pagination,
        ];
        return view('admin.product.index', $data);
    }

    public function create()
    {
        return view('admin.product.edit');
    }

    public function create_exe(Request $request)
    {
        $last_id = DB::transaction(function () use ($request) {
            $request = $this->fileService->create($request);
            $last_id = $this->productService->create($request);
            $this->categoryService->categorysFlontSet();
            return $last_id;
        });
        return redirect('admin/product/edit/' . $last_id)->with('one_time_mes', 1);
    }

    public function update(int $id)
    {
        $detail = $this->productService->updateDatas($id);
        $data = [
            'detail' => $detail,
            'select_category' => $detail->add_category->pluck('id')->toArray()
        ];
        return view('admin.product.edit', $data);
    }

    public function update_exe(Request $request)
    {
        DB::transaction(function () use ($request) {
            $request = $this->fileService->update($request);
            $this->productService->update($request);
            $this->categoryService->categorysFlontSet();
        });
        return redirect('admin/product/edit/' . $request->id)->with('one_time_mes', 2);
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

    public function on(Request $request): void
    {
        Product::whereIn('id', $request->vals)->update(['status' => config('const.STATUS_ON')]);
    }

    public function off(Request $request): void
    {
        Product::whereIn('id', $request->vals)->update(['status' => config('const.STATUS_OFF')]);
    }

    public function delete(Request $request): void
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
