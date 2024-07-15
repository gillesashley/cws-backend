<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['point_id', 'points', 'transaction_type', 'related_id', 'related_type'];

    public function point()
    {
        return $this->belongsTo(Point::class);
    }

    public function related()
    {
        return $this->morphTo();
    }
}
