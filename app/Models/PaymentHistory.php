<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentHistory extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const DISBURSEMENT_STATUS_SELECT = [
        '0' => 'শুরু হয়নি',
        '1' => 'সফল',
        '2' => 'বিফল',
    ];

    public $table = 'payment_histories';

    protected $dates = [
        'disbursement_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'payroll_id',
        'app_number',
        'stu_name',
        'brid',
        'bank_acc_no',
        'bank_acc_name',
        'student_bank_name',
        'student_bank_branch',
        'bank_routing_no',
        'student_division',
        'student_district',
        'student_upazila',
        'pay_amount',
        'service_provider',
        'disbursement_amount',
        'disbursement_date',
        'disbursement_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function payroll()
    {
        return $this->belongsTo(Payroll::class, 'payroll_id');
    }

    public function getDisbursementDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDisbursementDateAttribute($value)
    {
        $this->attributes['disbursement_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
