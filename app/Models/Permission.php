<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'permission_name',
        'role_id',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
