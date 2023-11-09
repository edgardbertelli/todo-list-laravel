<?php

namespace App\Repositories;

use App\Contracts\TaskContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaskRepository implements TaskContract
{
    /**
     * Lists all the tasks.
     */
    public function index()
    {
        return DB::table('tasks')->get();
    }

    /**
     * Creates a new task.
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        return DB::table('tasks')->insert([
            'title'        => $request->input('title'),
            'slug'         => Str::slug($request->input('title')),
            'description'  => $request->input('description'),
            'checklist_id' => $request->input('checklist_id'),
            'created_at'   => now()
        ]);
    }

    /**
     * Returns a task.
     * 
     * @param string $slug
     */
    public function show(string $slug)
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

    public function update(Request $request, string $slug)
    {
        DB::table('tasks')
           ->join('checklists', 'tasks.checklist_id', '=', 'checklists.id')
           ->join('categories', 'checklists.category_id', '=', 'categories.id')
           ->join('users', 'categories.user_id', '=', 'users.id')
           ->where('tasks.slug', $slug)
           ->where('categories.user_id', Auth::user()->id)
           ->update([
                'tasks.title'        => $request->input('title'),
                'tasks.slug'         => Str::slug($request->input('title')),
                'tasks.description'  => $request->input('description'),
                'tasks.checklist_id' => $request->input('checklist_id'),
                'tasks.updated_at'   => now()
           ]);

        $task = DB::table('tasks')
                   ->join('checklists', 'tasks.checklist_id', '=', 'checklists.id')
                   ->join('categories', 'checklists.category_id', '=', 'categories.id')
                   ->join('users', 'categories.user_id', '=', 'users.id')
                   ->select(['tasks.*', 'categories.name as category_name', 'checklists.name as checklist_name'])
                   ->where('tasks.slug', Str::slug($request->input('title')))
                   ->where('categories.user_id', Auth::user()->id)
                   ->first();

        return $task;
    }

    public function destroy(string $slug)
    {
        $task = DB::table('tasks')
                   ->join('checklists', 'tasks.checklist_id', '=', 'checklists.id')
                   ->join('categories', 'checklists.category_id', '=', 'categories.id')
                   ->join('users', 'categories.user_id', '=', 'users.id')
                   ->select(['tasks.*', 'categories.name as category_name', 'checklists.name as checklist_name'])
                   ->where('tasks.slug', $slug)
                   ->where('categories.user_id', Auth::user()->id)
                   ->delete();
    }
}
