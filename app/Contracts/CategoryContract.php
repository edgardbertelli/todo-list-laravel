<?php

namespace App\Contracts;

interface CategoryContract
{
    public function index();
    public function store(array $validated);
    public function show(string $slug);
    public function update(array $validated, string $slug);
    public function destroy(string $slug);
}