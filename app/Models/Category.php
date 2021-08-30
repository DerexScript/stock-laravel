<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $fillable = ['name', 'external'];

    public function products()
    {
        return $this->hasMany(Product::class); //fazer relação 1:n - tem muitos
    }
}
