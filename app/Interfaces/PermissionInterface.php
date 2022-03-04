<?php
namespace App\Interfaces;

interface PermissionInterface
{
    public function getAll();

    public function getById($permission);

    public function create(array $attributes);

    public function update(array $attributes, $permission);

    public function delete($permission);
}