<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShomoosTransaction extends Model
{
    protected $guarded = [];

    protected $casts = [
        'synced_at' => 'datetime',
    ];

    public function property(): BelongsTo { return $this->belongsTo(Property::class); }
    public function reservation(): BelongsTo { return $this->belongsTo(Reservation::class); }
}