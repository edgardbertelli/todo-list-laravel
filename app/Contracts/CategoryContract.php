<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface CategoryContract
{
    public function index();
    public function store(Request $request);
    public function show(string $category);
    public function update(Request $request, string $category);
    public function destroy(string $category);
}