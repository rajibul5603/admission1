<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const DEGREE_SELECT = [
        'lower_secondary' => 'নিম্নমাধ্যমিক (অষ্টম শ্রেণি)',
        'ssc'             => 'এসএসসি',
        'hsc'             => 'এইচএসসি',
        'Honors'          => 'অনার্স',
        'degree_pass'     => 'ডিগ্রী(পাশ)',
        'masters'         => 'মাস্টার্স',
        'phd'             => 'পিএইচডি',
        'mphill'          => 'এমফিল',
        'pgd'             => 'পিজিডি',
        'certificate'     => 'সার্টিফিকেট কোর্স',
    ];

    public $table = 'education';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'degree',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
