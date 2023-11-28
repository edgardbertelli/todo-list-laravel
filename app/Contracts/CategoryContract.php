<?php

namespace App\Contracts;

interface CategoryContract
{
    public function index();
    public function trash_index();
    public function store(array $validated);
    public function show(string $id);
    public function update(array $validated, string $id);
    public function destroy(string $id);
}