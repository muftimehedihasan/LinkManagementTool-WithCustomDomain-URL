<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Link extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'original_url', 'shortened_url', 'custom_domain'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
