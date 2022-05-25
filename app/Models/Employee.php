<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


/**
 * @property int $id
 * @property int department_id
 * @property string $name
 * @property string $birthday
 * @property string $job
 * @property bool $hourly
 * @property double $salary
 * @property int $hours
 * @property-read Department $department
 *
 * @see Employee::getTypeAttribute();
 * @property-read string $type
 *
 * @see Employee::getPriceAttribute();
 * @property-read string $price
 */
class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'name',
        'birthday',
        'job',
        'hourly',
        'salary',
        'hours'
    ];

    /**
     * @return HasOne
     */
    public function department(): HasOne
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    /**
     * @return string
     */
    public function getTypeAttribute(): string
    {
        return $this->hourly ? 'почасовая оплата' : 'ставка';
    }

    /**
     * @return float|int
     */
    public function getPriceAttribute()
    {
        return $this->hourly ? $this->salary * $this->hours : $this->salary;
    }
}
