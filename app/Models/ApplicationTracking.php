<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationTracking extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'application_trackings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id_no_id',
        'application_no',
        'cirID',
        'is_completed',
        'is_submitted',
        'ih_seen',
        'ih_approve',
        'ih_forwarded',
        'useo_forwarded',
        'pmeat_accepted',
        'pmeat_selected',
        'rejection_reaseon',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user_id_no()
    {
        return $this->belongsTo(User::class, 'application_no');
    }
    
    public function app_id()
    {
        return $this->belongsTo(GeneralInfo::class, 'application_no','application_no');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    
    public function circular()
    {
        return $this->belongsTo(Circular::class, 'cirID');
    }
}
