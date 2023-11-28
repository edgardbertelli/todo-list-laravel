<?php

namespace App\Models;

use App\Events\ChecklistCreated;
use App\Events\ChecklistDeleted;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checklist extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'category_id'];

    /**
     * The event map for the model.
     * 
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ChecklistCreated::class,
        'deleted' => ChecklistDeleted::class,
    ];

    /**
     * Get the category that owns the Checklist
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all of the tasks for the Checklist
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
