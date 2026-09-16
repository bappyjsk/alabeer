<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $guarded = [];

    public function property(): BelongsTo { return $this->belongsTo(Property::class); }
    public function roomType(): BelongsTo { return $this->belongsTo(RoomType::class); }
    public function reservations(): HasMany { return $this->hasMany(Reservation::class); }
    public function housekeepingTasks(): HasMany { return $this->hasMany(HousekeepingTask::class); }

    public function currentReservation()
    {
        return $this->hasOne(Reservation::class)->where('status', 'checked_in')->latest();
    }
}