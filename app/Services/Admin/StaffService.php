<?php

namespace app\Services\Admin;

use Illuminate\Http\Request;
use App\Admin;

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
        $q = new Admin;
        $q->fill($request->all())->save();
        $last_id = $q->id;
        return $last_id;
    }

    public function updateDatas(int $id): \App\Admin
    {
        $detail = Admin::find($id);
        if (empty($detail)) {
            abort('404');
        }
        return $detail;
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
