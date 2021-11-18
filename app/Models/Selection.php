<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Selection extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const USEO_APPROVAL_SELECT = [
        '0' => 'না',
        '1' => 'হ্যাঁ',
    ];

    public const PMEAT_APPROVAL_SELECT = [
        '0' => 'না',
        '1' => 'হ্যাঁ',
    ];

    public $table = 'selections';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'app_number',
        'user',
        'ih_comments',
        'ih_approval',
        'ih_submission',
        'useo_approval',
        'useo_submission',
        'pmeat_comments',
        'pmeat_approval',
        'eiin',
        'division',
        'district',
        'upazila',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
