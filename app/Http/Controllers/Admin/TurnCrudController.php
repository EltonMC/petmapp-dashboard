<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\TurnRequest as StoreRequest;
use App\Http\Requests\TurnRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class TurnCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class TurnCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Turn');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/turn');
        $this->crud->setEntityNameStrings('turn', 'turns');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();
        // modify fields
        $this->crud->modifyField('service_id', 
            [  // Select
                'label' => "Service",
                'type' => 'select2',
                'name' => 'id', // the db column for the foreign key
                'entity' => 'service', // the method that defines the relationship in your Model
                'attribute' => 'id', // foreign key attribute that is shown to user
                'model' => "App\Models\Service" // foreign key model
            ]
        );
        $this->crud->modifyField('day', 
            [ 
                'name' => 'day',
                'label' => "Day",
                'type' => 'select_from_array',
                'options' => ['mon' => 'Monday', 
                            'tue' => 'Tuesday', 
                            'wed' => 'Wednesday', 
                            'thu' => 'Thursday', 
                            'fri' => 'Friday',
                            'sat' => 'Saturday', 
                            'sun' => 'Sunday'
                        ],
                'allows_null' => false,
                'default' => 'mon',
            ]
        );
        $this->crud->modifyField('status', 
            [ 
                'name' => 'status',
                'label' => "Status",
                'type' => 'checkbox',
            ]
        );
        // add asterisk for fields that are required in TurnRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
