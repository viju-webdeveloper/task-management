<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
    ];
    /**
     * Get the tasks for the category.
     */

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
