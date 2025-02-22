<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'user_permissions';

    public $timestamps = false;

    protected $fillable = ['permission_title'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'permission_id');
    }
}
