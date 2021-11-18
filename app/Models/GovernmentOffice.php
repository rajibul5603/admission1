<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GovernmentOffice extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'government_offices';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ministry_name_id',
        'govt_ogranization_name',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function ministry_name()
    {
        return $this->belongsTo(MinistryDivision::class, 'ministry_name_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
