<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Circular extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const CIRCULAR_TYPE_SELECT = [
        '1' => 'ভর্তি সহায়তা ( Admission Assistance )',
        '2' => 'চিকিৎসা অনুদান ( Medical Grants)',
    ];

    public $table = 'circulars';

    protected $appends = [
        'circular_file',
    ];

    protected $dates = [
        'reference_date',
        'application_deadline',
        'institution_head_deadline',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'circular_type',
        'cirucular_name',
        'circular_year',
        'reference_number',
        'reference_date',
        'academic_year_id',
        'policy_id',
        'sec_stipend_amount',
        'hsec_stipend_amount',
        'hons_stipend_amount',
        'application_deadline',
        'institution_head_deadline',
        'circular_image',
        'circular_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getReferenceDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setReferenceDateAttribute($value)
    {
        $this->attributes['reference_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }

    public function policy()
    {
        return $this->belongsTo(Policy::class, 'policy_id');
    }

    public function getApplicationDeadlineAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setApplicationDeadlineAttribute($value)
    {
        $this->attributes['application_deadline'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getInstitutionHeadDeadlineAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setInstitutionHeadDeadlineAttribute($value)
    {
        $this->attributes['institution_head_deadline'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getCircularFileAttribute()
    {
        return $this->getMedia('circular_file')->last();
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
