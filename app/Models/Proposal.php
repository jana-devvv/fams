<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'objectives', 'budget', 'status'];

    // Relation Many to One
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
