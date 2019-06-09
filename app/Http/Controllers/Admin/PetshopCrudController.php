<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PetshopRequest as StoreRequest;
use App\Http\Requests\PetshopRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class PetshopCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PetshopCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Petshop');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/petshop');
        $this->crud->setEntityNameStrings('petshop', 'petshops');


        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        // remove columns
        $this->crud->removeColumn('description');
        $this->crud->removeColumn('logo');

        // remove fields
        // $this->crud->removeField('description');
        // $this->crud->removeField('num_services');
        // $this->crud->removeField('max_discount');
        // $this->crud->removeField('rating_average');

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

        $this->crud->modifyField('logo', 
            [
                'attributes' => [
                    'disabled'=>'disabled',
                ], // change the HTML attributes of your input]
            ]
        );

        $this->crud->addField([ // image
            'label' => "Logo",
            'name' => "image",
            'type' => 'image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
        ]);

        // add asterisk for fields that are required in PetshopRequest
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
