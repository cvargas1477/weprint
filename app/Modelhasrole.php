<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelhasrole extends Model
{
    protected $table = "model_has_roles";

    protected $guarded = ['role_id'];
}
