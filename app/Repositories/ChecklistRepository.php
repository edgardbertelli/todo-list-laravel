<?php

namespace App\Repositories;

use App\Contracts\ChecklistContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use stdClass;

class ChecklistRepository implements ChecklistContract
{
    /**
     * Lists all the checklists.
     * 
     * @return \Iluuminate\Support\Collection
     */
    public function index(): Collection
    {
        $checklists = DB::table('checklists')
                         ->join('categories', 'checklists.category_id', '=', 'categories.id')
                         ->join('users', 'categories.user_id', '=', 'users.id')
                         ->select(['checklists.*'])
                         ->where('categories.user_id', '=', Auth::user()->id)
                         ->get();

        return $checklists;
    }

    /**
     * Creates a new checklist.
     * 
     * @param  array  $validated
     * @return bool
     */
    public function store(array $validated): bool
    {
        $checklist = DB::table('checklists')
                        ->insert([
                            'name'        => $validated['name'],
                            'category_id' => $validated['category_id'],
                            'slug'        => Str::slug($validated['name']),
                            'created_at'  => now()
                        ]);

        return $checklist;
    }

    /**
     * Returns a checklist.
     * 
     * @param  string  $slug
     * @return stdClass
     */
    public function show(string $slug): stdClass
    {
        return DB::table('checklists')
                  ->join('categories', 'checklists.category_id', '=', 'categories.id')
                  ->join('users', 'categories.user_id', '=', 'users.id')
                  ->select([
                      'checklists.name',
                      'categories.name as category_name',
                      'checklists.slug',
                      'checklists.created_at',
                      'checklists.updated_at'
                  ])
                  ->where('checklists.slug', $slug)
                  ->where('categories.user_id', Auth::user()->id)
                  ->first();
    }

    /**
     * Updates a checklist.
     * 
     * @param  array  $validated
     * @param  string  $slug
     * @return stdClass
     */
    public function update(array $validated, string $slug): stdClass
    {
        DB::table('checklists')
           ->join('categories', 'checklists.category_id', '=', 'categories.id')
           ->join('users', 'categories.user_id', '=', 'users.id')
           ->where('checklists.slug', $slug)
           ->where('categories.user_id', Auth::user()->id)
           ->update([
               'checklists.name'        => $validated['name'],
               'checklists.slug'        => Str::slug($validated['name']),
               'checklists.category_id' => $validated['category_id'],
               'checklists.updated_at'  => now()
           ]);

        $category = DB::table('checklists')
                       ->join('categories', 'checklists.category_id', '=', 'categories.id')
                       ->join('users', 'categories.user_id', '=', 'users.id')
                       ->where('checklists.slug', Str::slug($validated['name']))
                       ->where('categories.user_id', Auth::user()->id)
                       ->select(['checklists.name', 'checklists.slug'])
                       ->first();
        
        return $category;
    }

    /**
     * Deletes a checklist.
     * 
     * @todo   Implement the removal of a checklist.
     * @param  string  $slug
     * @return bool
     */
    public function destroy(string $slug): bool
    {
        return true;
    }
}
