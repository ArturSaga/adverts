<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    use HasFactory;
    protected $fillable=[
        'category', 'subcategory', 'title', 'name', 'text'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
