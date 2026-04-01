<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicColumn extends Model
{
    //
    protected $fillable = ['table_id','column_name','type','nullable'];
}
