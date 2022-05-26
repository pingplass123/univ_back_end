<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
use App\Models\Subcategories;
  
class Post extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'userID','sub_id', 'hastag','image', 'nameCreate'
    ];
    protected $casts = [
        'hastag' => 'array',
        ];
    public function user(){
        return $this->belongsTo(User::Class,'userID');
    }
    public function comment(){
        return $this->hasMany(Comment::Class,'postID');
    }
    public function subcategories(){
        return $this->belongTo(Subcategories::Class,'sub_id');
    }
  

}