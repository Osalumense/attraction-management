<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attractions extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'location', 'price', 'image_path', 'image_public_id'];

    public static function checkIfAttractionExists($name)
    {
        return self::where('name', $name)->exists();
    }
}

