<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonPhoto extends Model
{
    use HasFactory;

    protected $table = 'person_photos';
    protected $fillable = ['photo'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

}
