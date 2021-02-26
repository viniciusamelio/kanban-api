<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model{
    protected $table = "tasks";

    protected $fillable = [
        'board_id','title','description','status'
    ];

    public $timestamps = true;
}