<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'persons';
    protected $fillable = ['name', 'surname', 'date_birth', 'name_mother', 'city_id', 'description', 'group_id'];

    public function photos()
    {
        return $this->hasMany(PersonPhoto::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
