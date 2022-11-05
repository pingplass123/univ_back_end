<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CouresComment;
use App\Models\Subcategories;
  
class Coures extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'userID','sub_id', 'hastag','image', 'nameCreate', 'videoList'
    ];
    protected $casts = [
        'hastag' => 'array',
        'videoList' => 'array'
        ];
    public function user(){
        return $this->belongsTo(User::Class,'userID');
    }
    public function comment(){
        return $this->hasMany(CouresComment::Class,'couresID');
    }
    public function subcategories(){
        return $this->belongTo(Subcategories::Class,'sub_id');
    }
  

}