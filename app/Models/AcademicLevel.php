<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicLevel extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'academic_levels';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'level_name',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function academicLevelLevelWiseClasses()
    {
        return $this->hasMany(LevelWiseClass::class, 'academic_level_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
