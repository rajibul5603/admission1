<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'districts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'division_name_id',
        'district_name',
        'district_name_en',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function districtNameThanas()
    {
        return $this->hasMany(Thana::class, 'district_name_id', 'id');
    }

    public function division_name()
    {
        return $this->belongsTo(Division::class, 'division_name_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
