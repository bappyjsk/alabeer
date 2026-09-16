<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HousekeepingTask extends Model
{
    protected $guarded = [];

    public function property(): BelongsTo { return $this->belongsTo(Property::class); }
    public function room(): BelongsTo { return $this->belongsTo(Room::class); }
}