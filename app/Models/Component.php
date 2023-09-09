<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;
    protected $fillable = ['turbine_id','name', 'grade'];

    public function turbine()
    {
        return $this->belongsTo(Turbine::class);
    }
}
