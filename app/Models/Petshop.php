<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Backpack\CRUD\CrudTrait;
use Cloudder;

class Petshop extends Model
{
    use CrudTrait;
    use HasRoles; 

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'petshops';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id', 'rating_average'];
    protected $fillable = [];
    // protected $hidden = ['rating_average'];
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

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function services(){
        return $this->hasMany('App\Service', 'petshop_id', 'id');
    }

    public function images(){
        return $this->hasMany('App\PetshopImage', 'petshop_id', 'id');
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

    public function setImageAttribute($value){
        $attribute_name = "logo";
        $disk = "public";
        $destination_path = "uploads/";

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
