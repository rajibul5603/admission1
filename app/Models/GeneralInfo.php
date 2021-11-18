<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralInfo extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const GENDER_SELECT = [
        '1' => 'ছেলে/পুরুষ (   Male)',
        '2' => 'মেয়ে/মহিলা (  Female)',
        '3' => 'অন্যান্যা(Others)',
    ];

    public $table = 'general_infos';

    protected $dates = [
        
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id_no',
        'application_no',
        'grants_name',
        'circular_id',
        'brid',
        'dob',
        'nid',
        'name',
        'father_name',
        'father_nid',
        'mother_name',
        'mother_nid',
        'dob',
        'age',
        'gender',
        'division_id',
        'district_id',
        'upazila_id',
        'union_id',
        'village',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function applicationNumberFamilyInfos()
    {
        return $this->hasMany(FamilyInfo::class, 'application_number_id', 'id');
    }

    public function appNumberDocuments()
    {
        return $this->hasMany(Document::class, 'app_number_id', 'id');
    }

    public function applicationNumberEducationInstituteInfos()
    {
        return $this->hasMany(EducationInstituteInfo::class, 'application_number_id', 'id');
    }

    public function appNumberAccountInfos()
    {
        return $this->hasMany(AccountInfo::class, 'app_number_id', 'id');
    }

    public function circular()
    {
        return $this->belongsTo(Circular::class, 'circular_id');
    }

   /* public function getDobAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
    
    */

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

    public function union()
    {
        return $this->belongsTo(Union::class, 'union_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
