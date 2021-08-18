<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $fillable = ['name'];



    public function category()
    {
        //tabela relacionada        tabela pivot
        return $this->belongsToMany("App\Models\Category", "permissions")->withPivot([
            'view', 'edit', 'delete', 'created_at', 'updated_at'
        ]);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }


}
