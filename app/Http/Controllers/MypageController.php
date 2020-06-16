<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Services\UsersAddressService;
use App\Services\UsersHistoryService;
use App\Libs\Breadcrumbs;
use App\Http\Requests\MypageAddressRequest;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    private $usersAddressService;
    private $usersHistoryService;

    public function __construct(
        UsersAddressService $usersAddressService,
        UsersHistoryService $usersHistoryService
    ) {
        $this->usersAddressService = $usersAddressService;
        $this->usersHistoryService = $usersHistoryService;
        //$this->middleware('verified');
        View::share('mypage', true);
    }

    public function index(): \Illuminate\View\View
    {
        return view('mypage.index');
    }

    public function address(): \Illuminate\View\View
    {
        $data = [
            'data' => $this->usersAddressService->list(),
        ];
        return view('mypage.address', $data);
    }

    public function addressApi()
    {
        return $this->usersAddressService->list();
    }

    public function addressApiUpdate(Request $request)
    {
        return $this->usersAddressService->detail($request->id);
    }

    public function addressApiUpdateExe(MypageAddressRequest $request)
    {
        return $this->usersAddressService->update($request);
    }
    
    public function history(): \Illuminate\View\View
    {
        $data = [
            'data' => $this->usersHistoryService->list(),
        ];
        return view('mypage.history', $data);
    }

    public function create(): \Illuminate\View\View
    {
        return view('mypage.address_form');
    }

    public function createRedirect(): \Illuminate\View\View
    {
        $data = [
            'redirect' => 1,
        ];
        return view('mypage.address_form', $data);
    }

    public function create_exe(MypageAddressRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->usersAddressService->create($request);
        if ($request->redirect == 1) {
            return redirect('purchase');
        } else {
            return redirect('mypage/address')->with('one_time_mes', 1);
        }
    }

    public function update(int $id = null): \Illuminate\View\View
    {
        $data = [
            'data' => $this->usersAddressService->detail($id),
        ];
        return view('mypage.address_form', $data);
    }

    public function update_exe(MypageAddressRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->usersAddressService->update($request);
        return redirect('mypage/address')->with('one_time_mes', 1);
    }
}
