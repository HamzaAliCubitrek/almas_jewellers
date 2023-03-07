<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends SpatiePermission
{
    use HasFactory, SoftDeletes;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
