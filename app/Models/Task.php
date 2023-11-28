<?php

namespace App\Models;

use App\Events\TaskCreated;
use App\Events\TaskDeleted;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'checklist_id'];

    /**
     * The event map for the model.
     * 
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TaskCreated::class,
        'deleted' => TaskDeleted::class,
    ];

    /**
     * Get the checklist that owns the Task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }
}
