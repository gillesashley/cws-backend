<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'image_url', 'expires_at', 'description', 'bannerable_id', 'bannerable_type'];

    public function bannerable()
    {
        return $this->morphTo();
    }
}
