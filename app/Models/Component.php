<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Component extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'turbine_id',
        'name',
        'grade',
    ];

    /**
     * Get the turbine that owns the component.
     * 
     * @return BelongsTo
     */
    public function turbine(): BelongsTo
    {
        return $this->belongsTo(Turbine::class);
    }
}
