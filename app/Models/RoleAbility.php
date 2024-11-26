<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoleAbility extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'ability',
    ];

    protected $casts = [
        'ability' => 'array',
    ];
    public $timestamps = false;

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }
}
