<?php

namespace App\Models;

use GuzzleHttp\Psr7\Query;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    
    public static function scopeFilter($query,$filter)
    {
        // if($searchValues){
        //     $query->where('title','Like','%'.$searchValues.'%')
        //           ->orWhere('body','Like','%'.$searchValues.'%');
        // }
        // return $query;

        // both method are same for search method only

        $query->when($filter['search']??null,function($query) use ($filter)
            {
                // logger('search query hit');
                $query
                ->where(function($query) use($filter){
                    $query->where('title','Like','%'.$filter['search'].'%')
                    ->orWhere('body','Like','%'.$filter['search'].'%');
                });
            }); 
        $query->when($filter['category']??null,function($query) use ($filter)
            {
                $query->whereHas('category',function($catQuery) use ($filter){
                    $catQuery->whereSlug($filter['category']);
                });
            });
        $query->when($filter['author']??null,function($query) use ($filter)
            {
                $query->whereHas('author',function($autQuery) use ($filter){
                    $autQuery->whereUsername($filter['author']);
                });
            });
    }

    
    public function category() // a blog belongs to a category
    {
        return $this->belongsTo(Category::class);
    }
    public function author() // a blog belongs to a user
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function subscribedUsers()
    {
        return $this->belongsToMany(User::class,'blogs_users');
    }
    public function isSubscribed()
    {
        return $this->subscribedUsers->contains('id',auth()->id());
    }
}
