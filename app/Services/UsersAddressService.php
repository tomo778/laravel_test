<?php

namespace app\Services;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\UsersAddress;
use Illuminate\Support\Facades\Auth;

class UsersAddressService
{
    public function list(): \Illuminate\Database\Eloquent\Collection
    {
        return UsersAddress::where('user_id', Auth::id())->get();
    }

    public function detail(int $id): \App\Models\UsersAddress
    {
        return UsersAddress::findOrFail($id);
    }

    public function create(Request $request): void
    {
        $request->merge([
            'user_id' => Auth::id(),
        ]);
        UsersAddress::create($request->all());
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
