<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    protected $guarded = [];

    public function property(): BelongsTo { return $this->belongsTo(Property::class); }
    public function folio(): BelongsTo { return $this->belongsTo(Folio::class); }
}