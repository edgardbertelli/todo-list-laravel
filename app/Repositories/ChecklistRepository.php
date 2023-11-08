<?php

namespace App\Repositories;

use App\Contracts\ChecklistContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChecklistRepository implements ChecklistContract
{
    /**
     * Lists all the checklists.
     */
    public function index()
    {
        $checklists = DB::table('checklists')
                         ->join('categories', 'checklists.category_id', '=', 'categories.id')
                         ->join('users', 'categories.user_id', '=', 'users.id')
                         ->select(['checklists.name', 'checklists.slug'])
                         ->where('categories.user_id', '=', Auth::user()->id)
                         ->get();

        return $checklists;
    }

    /**
     * Creates a new checklist.
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $checklist = DB::table('checklists')
                        ->insert([
                            'name'        => $request->input('name'),
                            'category_id' => $request->input('category_id'),
                            'slug'        => Str::slug($request->input('name'), '-', config('locale', 'en')),
                            'created_at'  => now()
                        ]);

        return $checklist;
    }

    /**
     * Returns a checklist.
     * 
     * @param string $slug
     */
    public function show(string $slug)
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
     * @param  \Illumiante\Http\Request  $request
     * @param  string  $id
     */
    public function update(Request $request, string $slug)
    {
        DB::table('checklists')
           ->join('categories', 'checklists.category_id', '=', 'categories.id')
           ->join('users', 'categories.user_id', '=', 'users.id')
           ->where('checklists.slug', $slug)
           ->where('categories.user_id', Auth::user()->id)
           ->update([
               'checklists.name'        => $request->input('name'),
               'checklists.slug'        => Str::slug($request->input('name')),
               'checklists.category_id' => $request->input('category_id'),
               'checklists.updated_at'  => now()
           ]);

        $category = DB::table('checklists')
                       ->join('categories', 'checklists.category_id', '=', 'categories.id')
                       ->join('users', 'categories.user_id', '=', 'users.id')
                       ->where('checklists.slug', Str::slug($request->input('name')))
                       ->where('categories.user_id', Auth::user()->id)
                       ->select(['checklists.name', 'checklists.slug'])
                       ->first();
        
        return $category;
    }
}
