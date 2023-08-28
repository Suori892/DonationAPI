<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_id', 'user_name', 'amount',
    ];
    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
}
