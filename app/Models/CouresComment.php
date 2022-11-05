<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Coures;
class CouresComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'description', 'score','userID','couresID','nameCreate'
    ];
    public function user(){
        return $this->belongsTo(User::Class,'userID');
    }
    public function posts(){
        return $this->belongsTo(Coures::Class,'couresID');
    }
    
}