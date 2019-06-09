<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ServiceRequest as StoreRequest;
use App\Http\Requests\ServiceRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class ServiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ServiceCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Service');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/service');
        $this->crud->setEntityNameStrings('service', 'services');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        $this->crud->addColumn([
            'name' => 'id', // The db column name
            'label' => "ID", // Table column heading
        ]);

        // delete fields
        $this->crud->removeField('max_discount');
        
        // modify column
        $this->crud->modifyColumn('petshop_id', 
            [  // Select
                'label' => "Petshop",
                'type' => 'select',
                'name' => 'petshop_id', // the db column for the foreign key
                'entity' => 'petshop', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "App\Models\Petshop" // foreign key model
            ]
        );

        // modify fields
        $this->crud->modifyField('petshop_id', 
            [  // Select
                'label' => "Petshop",
                'type' => 'select2',
                'name' => 'petshop_id', // the db column for the foreign key
                'entity' => 'petshop', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "App\Models\Petshop" // foreign key model
            ]
        );

        $this->crud->modifyField('type', 
            [ 
                'name' => 'type',
                'label' => "Type",
                'type' => 'select_from_array',
                'options' => ['shower' => 'Shower', 'cough' => 'Cough'],
                'allows_null' => false,
                'default' => 'shower',
            ]
        );
        $this->crud->modifyField('status', 
            [ 
                'name' => 'status',
                'label' => "Status",
                'type' => 'checkbox',
            ]
        );
        // add asterisk for fields that are required in ServiceRequest
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
