<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'contact',
        'flex',
        'size_id',
        'booked_for',
        'approved',
    ];

    /**
     * @return BelongsTo
     */
    public function carSize()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    /**
     * @return $this
     */
    public function approve(): self
    {
        $this->approved = 1;
        $this->save();

        return $this;
    }
}
