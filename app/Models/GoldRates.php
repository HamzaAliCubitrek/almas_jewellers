<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;

class GoldRates extends Model
{
    use HasFactory, SoftDeletes, UuidTrait;

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function sheet()
    {
        return $this->belongsTo(GoldRatesSheet::class, 'sheet_id');
    }

    public function category()
    {
        return $this->hasOne(User::class, 'category_id');
    }
}
