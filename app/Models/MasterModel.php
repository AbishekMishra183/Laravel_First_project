<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterModel extends Model
{
   use HasFactory;

   public function make()
    {
        return $this->belongsTo(MasterMake::class);
    }
}