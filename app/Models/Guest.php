<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guest extends Model
{
    protected $guarded = [];

    public function reservations(): HasMany { return $this->hasMany(Reservation::class); }
    public function folios(): HasMany { return $this->hasMany(Folio::class); }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}