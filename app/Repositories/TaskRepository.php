<?php

namespace App\Repositories;

use App\Contracts\TaskContract;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use stdClass;

class TaskRepository implements TaskContract
{
    /**
     * Lists all the tasks.
     * 
     * @return \Illuminate\Support\Collection
     */
    public function index(): Collection
    {
        return DB::table('tasks')->get();
    }

    /**
     * Creates a new task.
     * 
     * @param  array  $validated
     * @return bool
     */
    public function store(array $validated): bool
    {
        return DB::table('tasks')->insert([
            'title'        => $validated['title'],
            'slug'         => Str::slug($validated['title']),
            'description'  => $validated['description'],
            'checklist_id' => $validated['description'],
            'created_at'   => now()
        ]);
    }

    /**
     * Returns a task.
     * 
     * @param  string  $slug
     * @return stdClass
     */
    public function show(string $slug): stdClass
    {
        return DB::table('tasks')
                  ->join('checklists', 'tasks.checklist_id', '=', 'checklists.id')
                  ->join('categories', 'checklists.category_id', '=', 'categories.id')
                  ->join('users', 'categories.user_id', '=', 'users.id')
                  ->select(['tasks.*', 'categories.name as category_name', 'checklists.name as checklist_name'])
                  ->where('tasks.slug', $slug)
                  ->where('checklists.category_id', Auth::user()->id)
                  ->first();
    }

    /**
     * Updates a task.
     * 
     * @param  array  $validated
     * @param  string  $slug
     * @return stdClass
     */
    public function update(array $validated, string $slug): stdClass
    {
        DB::table('tasks')
           ->join('checklists', 'tasks.checklist_id', '=', 'checklists.id')
           ->join('categories', 'checklists.category_id', '=', 'categories.id')
           ->join('users', 'categories.user_id', '=', 'users.id')
           ->where('tasks.slug', $slug)
           ->where('categories.user_id', Auth::user()->id)
           ->update([
                'tasks.title'        => $validated['title'],
                'tasks.slug'         => Str::slug($validated['title']),
                'tasks.description'  => $validated['description'],
                'tasks.checklist_id' => $validated['checklist_id'],
                'tasks.updated_at'   => now()
           ]);

        $task = DB::table('tasks')
                   ->join('checklists', 'tasks.checklist_id', '=', 'checklists.id')
                   ->join('categories', 'checklists.category_id', '=', 'categories.id')
                   ->join('users', 'categories.user_id', '=', 'users.id')
                   ->select(['tasks.*', 'categories.name as category_name', 'checklists.name as checklist_name'])
                   ->where('tasks.slug', Str::slug($validated['title']))
                   ->where('categories.user_id', Auth::user()->id)
                   ->first();

        return $task;
    }

    /**
     * Removes a task.
     * 
     * @param  string  $slug
     * @return bool
     */
    public function destroy(string $slug): bool
    {
        return DB::table('tasks')
                   ->join('checklists', 'tasks.checklist_id', '=', 'checklists.id')
                   ->join('categories', 'checklists.category_id', '=', 'categories.id')
                   ->join('users', 'categories.user_id', '=', 'users.id')
                   ->select(['tasks.*', 'categories.name as category_name', 'checklists.name as checklist_name'])
                   ->where('tasks.slug', $slug)
                   ->where('categories.user_id', Auth::user()->id)
                   ->delete();
    }
}
