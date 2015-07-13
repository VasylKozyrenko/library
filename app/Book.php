<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'author', 'year', 'genre'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}