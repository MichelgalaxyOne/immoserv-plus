<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = ['nom', 'icone'];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}