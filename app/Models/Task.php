<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Task extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'tasks';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['name', 'description', 'status', 'start_date', 'end_date', 'completed_date'];

    public function markAsDoneBtn($crud = false)
    {
        if($this->completed_date) {
            return false;
        }  
        return '<a class="btn btn-xs btn-success" href="'. url('admin/task/done/'. $this->id) .'" data-toggle="tooltip" title="Mark the task as done."><i class="fa fa-check"></i> Done</a>';
    }
}
