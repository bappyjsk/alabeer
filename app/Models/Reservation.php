<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
    protected $guarded = [];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'actual_check_in_at' => 'datetime',
        'actual_check_out_at' => 'datetime',
    ];

    public function property(): BelongsTo { return $this->belongsTo(Property::class); }
    public function guest(): BelongsTo { return $this->belongsTo(Guest::class); }
    public function room(): BelongsTo { return $this->belongsTo(Room::class); }
    public function roomType(): BelongsTo { return $this->belongsTo(RoomType::class); }
    public function folio(): HasOne { return $this->hasOne(Folio::class); }
    public function shomoosTransactions(): HasMany { return $this->hasMany(ShomoosTransaction::class); }
}