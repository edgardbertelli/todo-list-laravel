<?php

namespace App\Repositories;

use App\Contracts\CategoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryContract
{
    /**
     * Lists user's registered categories.
     * 
     * @return \Illuminate\Support\Facades\DB
     */
    public function index()
    {
        $categories = DB::table('categories')
                        ->where('user_id', Auth::user()->id)
                        ->orderBy('name')
                        ->get();

        return $categories;
    }

    /**
     * Creates a new category.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function store(Request $request)
    {
        $category = DB::table('categories')->insert([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'user_id' => Auth::user()->id,
            'created_at' => now(),
        ]);

        return $category;
    }

    /**
     * Returns a category.
     * 
     * @param string $slug
     */
    public function show(string $slug)
    {
        $category = DB::table('categories')
                      ->where('slug', $slug)
                      ->where('user_id', Auth::user()->id)
                      ->first();

        return $category;
    }

    /**
     * Updates a category.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     */
    public function update(Request $request, string $slug)
    {
        DB::table('categories')
           ->where('slug', $slug)
           ->where('user_id', Auth::user()->id)
           ->update([
                'name' => $request->input('name'),
                'slug' => Str::slug($request->input('name')),
                'updated_at' => now()
           ]);

        $category = DB::table('categories')
                       ->where('slug', Str::slug($request->input('name')))
                       ->where('user_id', Auth::user()->id)
                       ->first();

        return $category;
    }

    /**
     * Removes a category.
     * 
     * @param string $slug
     */
    public function destroy(string $slug)
    {
        return DB::table('categories')
                 ->where('slug', $slug)
                 ->where('user_id', Auth::user()->id)
                 ->delete();
    }
}
