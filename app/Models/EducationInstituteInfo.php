<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationInstituteInfo extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'education_institute_infos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'application_number_id',
        'institute_division',
        'institute_district',
        'institute_upazila',
        'education_level_id',
        'class_name_id',
        'institute_name_id',
        'eiin_id',
        'last_study_class_id',
        'last_gpa',
        'last_gpa_total',
        'user_id_no',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function application_number()
    {
        return $this->belongsTo(GeneralInfo::class, 'application_number_id');
    }

    public function education_level()
    {
        return $this->belongsTo(AcademicLevel::class, 'education_level_id');
    }

    public function class_name()
    {
        return $this->belongsTo(LevelWiseClass::class, 'class_name_id');
    }

    public function institute_name()
    {
        return $this->belongsTo(EducationalInstitute::class, 'institute_name_id');
    }

    public function eiin()
    {
        return $this->belongsTo(EducationalInstitute::class, 'eiin_id');
    }

    public function last_study_class()
    {
        return $this->belongsTo(LevelWiseClass::class, 'last_study_class_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'institute_division');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'institute_district');
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'institute_upazila');
    }
}
