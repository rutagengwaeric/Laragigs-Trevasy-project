<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ListingController;
class Listing extends Model
{
    use HasFactory;
     protected $fillable = ['title','user_id','logo','tags','company','location','email','website','description'];

    public function scopeFilter($query , array $filter){
    //    dd($filter['tag']);
        if ($filter['tag'] ?? false) {
            $query->where('tags' , 'like', '%'. request('tag') .'%');
        }

        if ($filter['search'] ?? false) {
            $query->where('title' , 'like', '%'. request('search') .'%')
            ->orWhere('description' , 'like', '%'. request('search') .'%')
            ->orWhere('tags' , 'like', '%'. request('search') .'%');
        }
    }


    //  Relationship to User
     public function user(){
      return $this->belongsTo(User::class, 'user_id');
     }


}
