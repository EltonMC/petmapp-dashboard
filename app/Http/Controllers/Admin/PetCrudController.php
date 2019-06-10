<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PetRequest as StoreRequest;
use App\Http\Requests\PetRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class PetCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PetCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Pet');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/pet');
        $this->crud->setEntityNameStrings('pet', 'pets');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        // modify column
        $this->crud->modifyColumn('user_id', 
            [  // Select
                'label' => "User",
                'type' => 'select',
                'name' => 'user_id', // the db column for the foreign key
                'entity' => 'user', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "App\User" // foreign key model
            ]
        );
        
        // modify fields
        $this->crud->modifyField('user_id', 
            [  // Select
                'label' => "User",
                'type' => 'select2',
                'name' => 'user_id', // the db column for the foreign key
                'entity' => 'user', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "App\User" // foreign key model
            ]
        );
        $this->crud->modifyField('type', 
            [ 
                'name' => 'type',
                'label' => "Type",
                'type' => 'select_from_array',
                'options' => ['dog' => 'Cat', 
                            'cat' => 'Dog', 
                            'other' => 'Other', 
                        ],
                'allows_null' => false,
                'default' => 'dog',
            ]
        );

        $this->crud->modifyField('gender', 
            [ 
                'name' => 'gender',
                'label' => "Gender",
                'type' => 'select_from_array',
                'options' => ['male' => 'Male', 
                            'female' => 'Female', 
                            'other' => 'Other', 
                        ],
                'allows_null' => false,
                'default' => 'dog',
            ]
        );
        
        $this->crud->modifyField('castrated', 
            [ 
                'name' => 'castrated',
                'label' => "Status",
                'type' => 'checkbox',
            ]
        );

        // add asterisk for fields that are required in PetRequest
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
