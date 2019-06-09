<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PetshopImageRequest as StoreRequest;
use App\Http\Requests\PetshopImageRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class PetshopImageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PetshopImageCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\PetshopImage');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/petshopImage');
        $this->crud->setEntityNameStrings('petshopImage', 'petshop_images');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

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

        $this->crud->modifyField('image', 
            [
                'type' => 'text',
                'attributes' => [
                    'disabled'=>'disabled',
                ], // change the HTML attributes of your input]
            ]
        );

        $this->crud->addField([ // image
            'label' => "Image",
            'name' => "images",
            'type' => 'image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 0, // ommit or set to 0 to allow any aspect ratio
        ]);
        
        $this->crud->modifyField('status', 
            [ 
                'name' => 'status',
                'label' => "Status",
                'type' => 'checkbox',
            ]
        );
        // add asterisk for fields that are required in PetshopImageRequest
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
