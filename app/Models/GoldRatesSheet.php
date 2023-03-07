<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;

class GoldRatesSheet extends Model
{
    use HasFactory, SoftDeletes, UuidTrait;
    protected $table = 'gold_rates_sheets';

    protected $fillable = ["*"];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function rates()
    {
        return $this->hasMany(GoldRates::class, 'sheet_id');
    }
}
