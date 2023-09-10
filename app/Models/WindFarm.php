<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WindFarm extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'location',
    ];

    /**
     * Get the turbines for the wind farm.
     * 
     * @return HasMany
     */
    public function turbines(): HasMany
    {
        return $this->hasMany(Turbine::class);
    }
}
