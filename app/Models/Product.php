<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'amount', 'images', 'category_id', 'type_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id"); //relacão inversa - pertence a
    }

    public function type()
    {
        return $this->belongsTo(Type::class, "type_id"); //relacão inversa - pertence a
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id"); //relacão inversa - pertence a
    }

}
