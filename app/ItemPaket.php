<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\RatingPaket;

class ItemPaket extends Model
{
    /**
     * Table database
     */
    protected $table = 'item_pakets';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'admin_id','nama', 'deskripsi', 'info', 'penginapan', 'transportasi', 'makan', 'lokasi', 'gambar', 'tiket', 'harga'
    ];

    public function user() 
      { 
      	return $this->hasOne('App\User'); 
      }

    public function rating_pakets(){
      return $this->hasOne('App\RatingPaket');
    } 

     
}
