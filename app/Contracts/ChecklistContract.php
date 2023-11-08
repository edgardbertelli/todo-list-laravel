<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface ChecklistContract
{
    public function index();
    public function store(Request $request);
    public function show(string $slug);
    public function update(Request $request, string $slug);
}