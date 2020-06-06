<?php

namespace app\Services\Admin;

use Illuminate\Http\Request;
use App\Models\Staff;

class StaffService
{
    public function list(): \Illuminate\Pagination\LengthAwarePaginator
    {
        $paginate = Staff::paginate(20);
        return $paginate;
    }

    public function create(Request $request): int
    {
        $request->merge([
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
        ]);
        $q = new Staff;
        $q->fill($request->all())->save();
        $last_id = $q->id;
        return $last_id;
    }

    public function updateDatas(int $id): \App\Models\Staff
    {
        $detail = Staff::find($id);
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
        $q = Staff::findOrFail($request->id);
        $q->fill($request->all())->save();
    }
}
