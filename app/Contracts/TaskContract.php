<?php

namespace  App\Contracts;

interface TaskContract
{
    public function index();
    public function trash();
    public function store(array $validated);
    public function show(string $id);
    public function update(array $validated, string $id);
    public function restore(string $id);
    public function destroy(string $id);
    public function force(string $id);
}