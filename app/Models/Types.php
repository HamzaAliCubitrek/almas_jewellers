<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;

class Types extends Model
{
    use HasFactory, SoftDeletes, UuidTrait;
    protected $table = 'type';
    protected $fillable = ["*"];
}
