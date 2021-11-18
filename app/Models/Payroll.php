<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'payrolls';

    protected $dates = [
        'activation_date',
        'deactivation_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'payroll_name',
        'circular_id',
        'division_id',
        'district_id',
        'upazila_id',
        'total_student',
        'financial_institutaion',
        'total_assistance',
        'total_disbursement',
        'disbursement_status',
        'activation_date',
        'deactivation_date',
        'api_key',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function payrollPaymentHistories()
    {
        return $this->hasMany(PaymentHistory::class, 'payroll_id', 'id');
    }

    public function circular()
    {
        return $this->belongsTo(Circular::class, 'circular_id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id');
    }

    public function getActivationDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setActivationDateAttribute($value)
    {
        $this->attributes['activation_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDeactivationDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDeactivationDateAttribute($value)
    {
        $this->attributes['deactivation_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
