<?php

namespace App\Http\Controllers\Admin;

// 以下を追加
use App\Http\Controllers\Controller;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
use DB;

class CategoryController extends Controller
{

    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $pagination = $this->categoryService->list();
        $data = [
            'pagination' => $pagination,
        ];
        return view('admin.category.index', $data);
    }

    public function create()
    {
        return view('admin.category.edit');
    }

    public function create_exe(Request $request, Category $Category)
    {
        $last_id = DB::transaction(function () use ($request) {
            return $this->categoryService->create($request);
        });
        return redirect('admin/category/edit/' . $last_id)->with('one_time_mes', 1);
    }

    public function update($id)
    {
        $detail = $this->categoryService->updateDatas($id);
        $data = [
            'detail' => $detail,
        ];
        return view('admin.category.edit', $data);
    }

    public function update_exe(Request $request)
    {
        DB::transaction(function () use ($request) {
            $this->categoryService->update($request);
            $this->categoryService->categorysFlontSet();
        });
        return redirect('admin/category/edit/' . $request->id)->with('one_time_mes', 2);
    }

    public function val(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'  => 'required',
            'text' => 'required',
        ]);

        if ($validator->fails()) {
            return json_encode(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
        } else {
            return json_encode(['success' => true]);
        }
    }
}
