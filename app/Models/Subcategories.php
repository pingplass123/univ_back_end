<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Catagory;
use App\Models\Post;

class Subcategories extends Model
{
    use HasFactory;
    protected $fillable = ['sub_id', 'categoryID', 'urlPhoto', 'description'];

    public function catagory(){
        return $this->belongsTo(Catagory::Class,'catagoryID');
    }
    public function post(){
        return $this->hasMany(Post::Class,'sub_id');
    }
}



