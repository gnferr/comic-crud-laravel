<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComicModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comic';
    protected $primaryKey = 'id';

    protected $fillable = ['title', 'slug', 'type', 'genre', 'description', 'cover'];
}
