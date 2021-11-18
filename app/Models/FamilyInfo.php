<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyInfo extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const GUARDIAN_EDUCATION_SELECT = [
        'illeterate'             => 'নিরক্ষর',
        'Class Five Passed'      => 'ক্লাস ফাইভ পাস',
        'Below Class 8'          => 'ক্লাস 8 এর নীচে',
        'SSC'                    => 'এসএসসি',
        'HSC'                    => 'এইচএসসি',
        'Honours/ Degree Passed' => 'অনার্স / ডিগ্রি উত্তীর্ণ',
        'Masters Passed'         => 'স্নাতকোত্তর পাস',
    ];

    public $table = 'family_infos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id_no',
        'application_number_id',
        'familystatus_id',
        'guardian_occupation_id',
        'guardian_education',
        'guardian_land',
        'guardian_annual_income',
        'family_member',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function application_number()
    {
        return $this->belongsTo(GeneralInfo::class, 'application_number_id');
    }

    public function familystatus()
    {
        return $this->belongsTo(FamilyStatus::class, 'familystatus_id');
    }

    public function guardian_occupation()
    {
        return $this->belongsTo(Occupation::class, 'guardian_occupation_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
