<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    //
    $fillable = ['quote_id', 'ruta'];

    public function quote()
    {
      return $this->belongsTo(Quote::class);
    }
}
