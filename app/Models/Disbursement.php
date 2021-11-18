<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disbursement extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'disbursements';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'app_number',
        'stu_name',
        'brid',
        'acc_no',
        'acc_name',
        'bank_name',
        'bank_branch',
        'routing_no',
        'student_division',
        'student_district',
        'student_upazila',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
