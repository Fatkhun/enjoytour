<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ItemPaket;

class RatingPaket extends Model
{
      /**
       * Table database
       */
      protected $table = 'rating_pakets';
      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $fillable = [
        'user_id', 'nama_wisata','nama', 'rating', 'review'
      ];

      /**
       * one to one relationships
       */
      public function item_pakets()
      {
        return $this->belongsTo('App\ItemPaket');
      }
}
