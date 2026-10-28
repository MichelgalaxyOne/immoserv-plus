<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['demande_id', 'sender_id', 'contenu', 'lu'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function demande()
    {
        return $this->belongsTo(Demande::class);
    }
}