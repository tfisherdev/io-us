<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasUuids;
    
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = ['name', 'created_by'];
}
