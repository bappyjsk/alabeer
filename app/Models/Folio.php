<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Folio extends Model
{
    protected $guarded = [];

    public function property(): BelongsTo { return $this->belongsTo(Property::class); }
    public function reservation(): BelongsTo { return $this->belongsTo(Reservation::class); }
    public function guest(): BelongsTo { return $this->belongsTo(Guest::class); }
    public function items(): HasMany { return $this->hasMany(FolioItem::class); }
    public function payments(): HasMany { return $this->hasMany(Payment::class); }
    public function invoice(): HasOne { return $this->hasOne(Invoice::class); }
}