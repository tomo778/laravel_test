<?php

namespace app\Services;

use App\Models\UsersHistory;
use Illuminate\Support\Facades\Auth;

class UsersHistoryService
{
    public function list(): \Illuminate\Database\Eloquent\Collection
    {
        return UsersHistory::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('order_id');
    }
}
