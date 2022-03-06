<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    // relation entre article et le user: un article appartient à un utilisateur.

    use HasFactory;

    //protected $fillable = ['title', 'user_id', 'slug', 'content', 'category_id'];
    protected $guarded = ['user_id', 'slug'];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class); // un article appartient à un utilisateur
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault([
            'name' => 'Catégorie anonyme.',
        ]);
    }
}
