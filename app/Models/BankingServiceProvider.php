<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankingServiceProvider extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const CATEGORY_SELECT = [
        'c'  => 'কেন্দ্রীয় ব্যাংক ( Central Bank )',
        'gc' => 'সরকারী ব্যাংক (Public Bank )',
        'pc' => 'বেসরকারী ব্যাংক (Private Bank)',
        'gs' => 'সরকারী  বিশেষায়িত ব্যাংক (Public Specialized Bank )',
        'ps' => 'বেসরকারী বিশেষায়িত ব্যাংক (Private Specialized Bank )',
        'fc' => 'বিদেশী ব্যাংক (Foreign Bank)',
        'nb' => 'অ-ব্যাংক আর্থিক প্রতিষ্ঠান(NBFI)',
    ];

    public $table = 'banking_service_providers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'bank_type_id',
        'head_office',
        'known_as',
        'swift_code',
        'category',
        'website',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function bankNameBankBranches()
    {
        return $this->hasMany(BankBranch::class, 'bank_name_id', 'id');
    }

    public function bank_type()
    {
        return $this->belongsTo(BankingType::class, 'bank_type_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
