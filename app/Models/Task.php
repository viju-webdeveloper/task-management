<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    protected $table = 'tasks';

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'due_date',
        'status',
        'priority',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];
    
    /**
     * relationship with User model
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * relationship with Category model
     */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
