<?php

namespace app\Services\Admin;

use Illuminate\Http\Request;
use App\Models\Admin;

class StaffService
{
    public function list(): \Illuminate\Pagination\LengthAwarePaginator
    {
        $paginate = Admin::paginate(20);
        return $paginate;
    }

    public function create(Request $request): int
    {
        $request->merge([
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
        ]);
        $q = Admin::create($request->all());
        return $q->id;
    }

    public function updateDatas(int $id): \App\Models\Admin
    {
        return Admin::findOrFail($id);
    }

    public function update(Request $request): void
    {
        if (!empty($request->password)) {
            $request->merge([
                'password' => password_hash($request->password, PASSWORD_DEFAULT),
            ]);
        } else {
            $request->offsetUnset('password');
        }
        $q = Admin::findOrFail($request->id);
        $q->fill($request->all())->save();
    }
}
