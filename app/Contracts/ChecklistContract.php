<?php

namespace App\Contracts;

interface ChecklistContract
{
    public function index();
    public function store(array $validated);
    public function show(string $id);
    public function update(array $validated, string $id);
    public function destroy(string $id);
}