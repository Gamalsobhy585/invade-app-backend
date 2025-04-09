<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['ar_name', 'en_name'];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->ar_name : $this->en_name;
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
