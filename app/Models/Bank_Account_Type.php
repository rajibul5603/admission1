<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank_Account_Type extends Model
{
    
    protected $fillable = [
        'account_type',
    ]; 
    
    use HasFactory;
}
