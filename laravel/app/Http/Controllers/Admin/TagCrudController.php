<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\TagRequest as StoreRequest;
use App\Http\Requests\TagRequest as UpdateRequest;

/**
 * Class TagCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class TagCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Tag');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/tag');
        $this->crud->setEntityNameStrings('tag', 'tags');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setColumns(['name', 'slug']);

        $this->crud->addColumn([
            'name' => 'id',
            'type' => 'integer',
            'label' => 'UID'
        ]);

        $this->crud->addColumn([
            'name' => 'lft',
            'type' => 'integer',
            'label' => 'Order'
        ]);

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => "Наименование"
        ]);

        $this->crud->addField([
            'name' => 'slug',
            'type' => 'text',
            'label' => "URL Segment (slug)"
        ]);

        $this->crud->addField([
            'name' => 'dates',
            'label' => 'Vue dates',
            'type' => 'myvue',
            'hint' => 'Your hint will be here',
            'another_attribute' => false
        ]);

        // add asterisk for fields that are required in TagRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

        $this->crud->enableReorder('name', 1);
        $this->crud->allowAccess('reorder');
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
