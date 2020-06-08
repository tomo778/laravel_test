<?php

namespace app\Services;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\UsersAddress;
use Illuminate\Support\Facades\Auth;

class UsersAddressService
{
    public function list()
    {
        return UsersAddress::where('user_id', Auth::id())->get();
    }

    public function detail(int $id)
    {
        return UsersAddress::find($id);
    }

    public function create(Request $request): void
    {
        $request->merge([
            'user_id' => Auth::id(),
        ]);
        $q = new UsersAddress;
        $q->fill($request->all())->save();
    }

    public function update(Request $request): void
    {
        $request->merge([
            'user_id' => Auth::id(),
        ]);
        $q = UsersAddress::findOrFail($request->id);
        $q->fill($request->all())->save();
    }
}
