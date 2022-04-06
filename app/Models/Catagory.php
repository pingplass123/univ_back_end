<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategories;

class Catagory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public $timestamps = false;

    public function supcatagory(){
        return $this->hasMany(Subcategories::Class,'catagoryID');
    }
  
}
