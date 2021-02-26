<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model{
    protected $table = "boards";

    protected $fillable = [
        'title','description','color','user_id'
    ];

    public function tasks(){
        return $this->hasMany(\App\Models\Task::class);
    }

    public $timestamps = true;
}