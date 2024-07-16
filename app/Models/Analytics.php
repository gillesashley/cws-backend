<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    use HasFactory;

    protected $fillable = ['entity_type', 'entity_id', 'metric', 'value', 'date'];

    public function entity()
    {
        return $this->morphTo();
    }
}
