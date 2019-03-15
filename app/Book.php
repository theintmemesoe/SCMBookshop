<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Author;
use App\Genre;
use DB;

class Book extends Model
{
    protected $fillable = [
        'name', 'price', 'author_id','genre_id','image','sample_pdf','published_date','description','create_user_id','updated_user_id','deleted_user_id','deleted_at'
    ];
 

    // public function author(){
    //     return $this->belongsTo('App\Author');
    // }
    // public function genre(){
    //     return $this->belongsTo('App\Genre');
    // }

    public function author(){
    	return $this->belongsTo(Author::class);
    }
    public function genre(){
    	return $this->belongsTo(Genre::class);
    }
    public $table = "books";

    public static function insertBook($data){
        if(!empty($data)) {
        
        DB::table('books')
        ->where('name', $data['name'])
        ->update($data);
        }
        else{
        DB::table('books')->insert($data);
        }
        }
       
}
