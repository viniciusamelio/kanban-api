<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model{
    protected $table = "tasks";

    protected $fillable = [
        'board_id','title','description','status'
    ];

    public function board(){
        return $this->belongsTo(\App\Models\Board::class,'board_id');
    }

    public $timestamps = true;
}