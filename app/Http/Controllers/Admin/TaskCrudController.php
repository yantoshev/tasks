<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\TaskRequest as StoreRequest;
use App\Http\Requests\TaskRequest as UpdateRequest;

class TaskCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Task');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/tasks');
        $this->crud->setEntityNameStrings('task', 'tasks');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->setFromDb();

        $this->crud->removeField('status', 'update/create/both');
        $this->crud->removeField('completed_date', 'update/create/both');
        $this->crud->addButtonFromModelFunction('line', 'mark_as_Done', 'markAsDoneBtn', 'beginning'); 
    }

    public function store(StoreRequest $request)
    {
        $redirect_location = parent::storeCrud($request);
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        $redirect_location = parent::updateCrud($request);
        return $redirect_location;
    }

    public function markAsDone() 
    {
        $id = \Request::segment(4);
        $data = [
            'status' => 'Completed',
            'completed_date' => date('Y-m-d H:i:s')
        ];
        $this->crud->update($id, $data);

        return redirect('admin/tasks');
    }
}
