<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Union extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'unions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'upazila_id',
        'union_name',
        'union_name_en',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
