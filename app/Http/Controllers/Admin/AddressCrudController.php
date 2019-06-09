<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\AddressRequest as StoreRequest;
use App\Http\Requests\AddressRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class AddressCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class AddressCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Address');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/address');
        $this->crud->setEntityNameStrings('address', 'addresses');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        // remove fields
        $this->crud->removeField('latitude');
        $this->crud->removeField('longitude');

        // remove columsn
        $this->crud->removeColumn('latitude');
        $this->crud->removeColumn('longitude');

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

        // add asterisk for fields that are required in AddressRequest
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
