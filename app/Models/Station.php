<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     schema="Station",
 *     type="object",
 *     description="Станция Технического Обслуживания",
 *     title="СТОА",
 *     required={"name"},
 *     @OA\Property(
 *         property="name",
 *         format="string",
 *         type="string",
 *         description="name",
 *         title="name",
 *         example="Название"
 *     ),
 *     @OA\Property(
 *         property="address",
 *         format="string",
 *         type="string",
 *         description="address",
 *         title="address",
 *         example="Адресс"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         format="text",
 *         type="text",
 *         description="description",
 *         title="description",
 *         example="Описание"
 *     )
 * )
 */
class Station extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'description',
    ];

    public function schedules(): HasMany
    {
        return $this->hasMany(StationSchedule::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
