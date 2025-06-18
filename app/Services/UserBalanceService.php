<?php

namespace App\Services;

use App\Models\User;
use App\Models\Group;

class UserBalanceService
{
    public function getGroupBalance(User $user, Group $group): array
    {
        // Total paid by user in the group
        $totalPaid = $user->expensesPaid()
            ->where('group_id', $group->id)
            ->sum('amount');

        // Total owed by user in the group (via pivot)
        $totalOwed = $user->expensesOwed()
            ->where('expenses.group_id', $group->id)
            ->wherePivot('is_paid', false)
            ->sum('expense_user.amount_owed');

        return [
            'group_id'     => $group->id,
            'total_paid'   => $totalPaid,
            'total_owed'   => $totalOwed,
            'net_balance'  => $totalPaid - $totalOwed,
        ];
    }
}
