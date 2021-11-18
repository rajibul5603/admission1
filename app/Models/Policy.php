<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Policy extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const POLICY_YEAR_SELECT = [
        '2021' => '2021',
        '2022' => '2022',
        '2023' => '2023',
        '2024' => '2024',
        '2025' => '2025',
        '2026' => '2026',
        '2027' => '2027',
        '2028' => '2028',
        '2029' => '2029',
        '2030' => '2030',
    ];

    public $table = 'policies';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'policy_name',
        'policy_year',
        'last_gpa',
        'max_annual_income',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function policyCirculars()
    {
        return $this->hasMany(Circular::class, 'policy_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
