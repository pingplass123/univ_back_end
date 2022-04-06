<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class role extends Model
{
    use HasFactory;
    protected $fillable = ['utype'];

    public function user(){
        return $this->hasMany(User::Class);
    }

    
}
