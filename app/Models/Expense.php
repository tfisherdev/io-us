<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Expense extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'group_id',
        'paid_by_user_id',
        'amount',
        'description',
        'date',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    // The group this expense belongs to
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    // The user who paid
    public function payer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'paid_by_user_id');
    }

    // The users who owe money (participants)
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('amount_owed')
            ->withTimestamps();
    }
}
