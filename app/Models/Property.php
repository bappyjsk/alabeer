<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    protected $guarded = [];

    public function rooms(): HasMany { return $this->hasMany(Room::class); }
    public function roomTypes(): HasMany { return $this->hasMany(RoomType::class); }
    public function reservations(): HasMany { return $this->hasMany(Reservation::class); }
    public function folios(): HasMany { return $this->hasMany(Folio::class); }
}