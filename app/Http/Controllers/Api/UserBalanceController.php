<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Services\UserBalanceService;

class UserBalanceController extends Controller
{
    protected UserBalanceService $balanceService;

    public function __construct(UserBalanceService $balanceService)
    {
        $this->balanceService = $balanceService;
    }

    public function show(Request $request, Group $group)
    {
        $user = $request->user();

        $balance = $this->balanceService->getGroupBalance($user, $group);

        return response()->json($balance);
    }
}
