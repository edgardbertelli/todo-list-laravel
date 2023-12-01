<?php

namespace App\Contracts;

interface TeamContract
{
    public function index();
    public function store(array $validated);
    public function attach(array $validated, string $id);
    public function show(string $id);
    public function update(array $validated, string $id);
    public function destroy(string $id);
}