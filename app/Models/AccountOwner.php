<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountOwner extends Model
{
    protected $fillable = [
        'owner',
    ];

    use HasFactory;
}
