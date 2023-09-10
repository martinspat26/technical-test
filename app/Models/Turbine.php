<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Turbine extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'wind_farm_id',
    ];

    /**
     * Get the components for the turbine.
     * 
     * @return HasMany
     */
    public function components(): HasMany
    {
        return $this->hasMany(Component::class);
    }

    /**
     * Get the wind farm that owns the turbine.
     * 
     * @return BelongsTo
     */
    public function windFarm(): BelongsTo
    {
        return $this->belongsTo(WindFarm::class);
    }
}
