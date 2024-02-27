<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'persons';
    protected $fillable = ['name', 'surname', 'date_birth', 'name_mother', 'address', 'description'];

    public function photos()
    {
        return $this->hasMany(PersonPhoto::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
