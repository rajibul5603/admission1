<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstituteBankAccount extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'institute_bank_accounts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'banking_type_id',
        'account_name',
        'account_number',
        'bank_name_id',
        'branch_name_id',
        'routing_no_id',
        'eiin_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function banking_type()
    {
        return $this->belongsTo(BankingType::class, 'banking_type_id');
    }

    public function bank_name()
    {
        return $this->belongsTo(BankingServiceProvider::class, 'bank_name_id');
    }

    public function branch_name()
    {
        return $this->belongsTo(BankBranch::class, 'branch_name_id');
    }

    public function routing_no()
    {
        return $this->belongsTo(BankBranch::class, 'routing_no_id');
    }

    public function eiin()
    {
        return $this->belongsTo(EducationalInstitute::class, 'eiin_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
