<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turbine extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'wind_farm_id'];

    public function components()
    {
        return $this->hasMany(Component::class);
    }
    
    public function windFarm()
    {
        return $this->belongsTo(WindFarm::class);
    }
}
