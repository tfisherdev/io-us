<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Group;

class UserBalanceRepository
{
    public function getPaidAmount(User $user, Group $group): float
    {
        return $user->expensesPaid()
            ->where('group_id', $group->id)
            ->sum('amount');
    }

    public function getOwedAmount(User $user, Group $group): float
    {
        return $user->expensesOwed()
            ->where('expenses.group_id', $group->id)
            ->wherePivot('is_paid', false)
            ->sum('expense_user.amount_owed');
    }
}
