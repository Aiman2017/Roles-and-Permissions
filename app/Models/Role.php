<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'/**'created_by',**/];

    public function abilities(): hasMany
    {
        return $this->hasMany(RoleAbility::class);
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user');
    }

    public function getDescriptionAttribute($value): string
    {
        return ucfirst(strtolower($value));
    }
    public static function createWithRoleAbilities($request): void
    {
        DB::beginTransaction();
        try {
            $role = Role::query()->create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            if ($request->has('abilities')) {
                $abilities = [];

                foreach ($request->abilities as $abilityCode => $isSelected) {
                    $abilities[] = $abilityCode;
                }

                RoleAbility::query()->create([
                    'role_id' => $role->id,
                    'ability' => $abilities,
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Role creation failed', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            // Rethrow the exception or handle it accordingly
            throw new \Exception('Error creating role with abilities: '.$e->getMessage());
        }
    }
}
