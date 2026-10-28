<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
    'user_id',
    'categorie_id',
    'titre',
    'description',
    'localisation',
    'latitude',
    'longitude',
    'prix',
    'image',
    'statut',
    ];

    // Un service appartient à un prestataire
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un service appartient à une catégorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    // Un service a plusieurs demandes
    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }

    // Un service a plusieurs avis
    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function images()
{
    return $this->hasMany(ServiceImage::class);
}

public function imagePrincipale()
{
    return $this->hasOne(ServiceImage::class)->where('principale', true);
}
}