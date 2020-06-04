<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\View;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Libs\Breadcrumbs;

class ProductController extends Controller
{
    private $productService;
    private $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index() :\Illuminate\View\View
    {
        $pagination = $this->productService->topPage();
        $data = [
            'pagination' => $pagination,
        ];
        return view('index', $data);
    }

    public function detail(int $id) :\Illuminate\View\View
    {
        $request = $this->productService->detailPage($id);
        $category = collect($request->add_category)->first()->toArray();
        Breadcrumbs::push($category['title'], route('category', $category['id']));
        Breadcrumbs::push($request->title);
        $data = [
            'result' => $request,
            'categorys' => $request->add_category,
            'Breadcrumbs' => Breadcrumbs::get()
        ];
        return view('detail', $data);
    }

    public function category(int $id) :\Illuminate\View\View
    {
        $paginate = $this->productService->categoryDetail($id);
        $category = $this->categoryService->categoryGet($id);
        Breadcrumbs::push($category['title']);
        $data = [
            'paginate' => $paginate,
            'title' => $category['title'],
            'Breadcrumbs' => Breadcrumbs::get()
        ];
        return view('category', $data);
    }
}
