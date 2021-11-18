<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LevelWiseClass extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'level_wise_classes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'class_name',
        'academic_level_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function academic_level()
    {
        return $this->belongsTo(AcademicLevel::class, 'academic_level_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
