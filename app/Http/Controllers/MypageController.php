<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Services\CategoryService;
use App\Services\MypageService;
use App\Libs\Breadcrumbs;
use App\Http\Requests\MypageUpdateRequest;
use App\Models\UsersAddress;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    // private $MypageService;
    // private $categoryService;

    // public function __construct(MypageService $MypageService, CategoryService $categoryService)
    // {
    //     $this->MypageService = $MypageService;
    //     $this->categoryService = $categoryService;
    // }

    public function __construct()
    {
        $this->middleware('auth');
        View::share('mypage', true);
    }

    public function index(): \Illuminate\View\View
    {
        // $pagination = $this->MypageService->list();
        // $data = [
        //     'pagination' => $pagination,
        // ];
        return view('mypage.index');
    }

    public function address(): \Illuminate\View\View
    {
        $data = UsersAddress::where('user_id', Auth::id())->get();
        $data = [
            'data' => $data,
        ];
        return view('mypage.address', $data);
    }

    public function update(int $id = null): \Illuminate\View\View
    {
        $data = UsersAddress::find($id);
        $data = [
            'data' => $data,
        ];
        return view('mypage.update', $data);
    }

    public function update_exe(MypageUpdateRequest $request): \Illuminate\Http\RedirectResponse
    {
        if (!empty($request->id)) {
            $request->merge([
                'user_id' => Auth::id(),
            ]);
            $q = UsersAddress::findOrFail($request->id);
            $q->fill($request->all())->save();
        } else {
            $request->merge([
                'user_id' => Auth::id(),
            ]);
            $q = new UsersAddress;
            $q->fill($request->all())->save();
        }
        return redirect('mypage/address')->with('one_time_mes', 1);
    }
}
