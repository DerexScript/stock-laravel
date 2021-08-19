<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $fillable = ['name'];


    public function permissions(){
        return $this->morphedByMany(Permission::class, "roleable"); //transformado por muitos
    }

    public function categories()
    {
        return $this->morphedByMany(Category::class, "roleable");  //transformado por muitos
    }

    public function users()
    {
        return $this->hasMany(User::class); //fazer relação 1:n - tem muitos
    }


}
