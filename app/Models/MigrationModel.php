<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MigrationModel extends Model
{
    //
      protected $fillable = ['table_id','column_name','type','nullable'];
}
