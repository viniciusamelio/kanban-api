<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model{
    protected $table = "boards";

    protected $fillable = [
        'title','description','color','user_id'
    ];

    public $timestamps = true;
}