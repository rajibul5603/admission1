<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationalInstitute extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'educational_institutes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'institution_eiin_no',
        'institution_name',
        'institution_code',
        'mpo_number',
        'legal_status_id',
        'institute_head',
        'email',
        'mobile_phone',
        'phone',
        'division_id',
        'district_id',
        'upazila_id',
        'union_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

   

    public function education_institute()
    {
        return $this->belongsTo(EducationInstituteInfo::class, 'institute_name_id');
    }
    public function last_class()
    {
        return $this->belongsTo(LevelWiseClass::class, 'last_study_class_id');
    }

    public function eiinInstituteBankAccounts()
    {
        return $this->hasMany(InstituteBankAccount::class, 'eiin_id', 'id');
    }

    public function legal_status()
    {
        return $this->belongsTo(InstitutLegalStatus::class, 'legal_status_id');
    }

    public function academic_levels()
    {
        return $this->belongsToMany(AcademicLevel::class);
    }

    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class);
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

    public function union()
    {
        return $this->belongsTo(Union::class, 'union_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
