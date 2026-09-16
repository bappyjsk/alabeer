<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $guarded = [];

    protected $casts = [
        'paid_at' => 'datetime',
        'is_refund' => 'boolean',
    ];

    public function folio(): BelongsTo { return $this->belongsTo(Folio::class); }
    public function property(): BelongsTo { return $this->belongsTo(Property::class); }
}