<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Backpack\CRUD\CrudTrait;
use Cloudder;

class PetshopImage extends Model
{
    use CrudTrait;
    use HasRoles; 

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'petshop_images';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function petshop(){
        return $this->belongsTo('App\Models\Petshop');
    }
    
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setImagesAttribute($value){
        $attribute_name = "image";
        // $disk = "public";
        // $destination_path = "uploads/";

        // if the image was erased
        // if ($value == null) {
        //     // delete the image from disk
        //     \Storage::disk($disk)->delete($this->{$attribute_name});

        //     // set null in the database column
        //     $this->attributes[$attribute_name] = null;
        // }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value)->encode('jpg', 90);
            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';
            // 2. Store the image on disk.

            // \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            $resp = Cloudder::upload($value, $options = array());
            $result = Cloudder::getResult();

            // 3. Save the path to the database
            $this->attributes[$attribute_name] = $result['secure_url'];
        }
    }
}
