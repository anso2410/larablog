<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // un commentaire appartient à un article
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function user() // un commentaire appartient à un utilisateur
    {
        return $this->belongsTo(User::class);
    }
}
