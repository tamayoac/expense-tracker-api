<?php
namespace App\Interfaces;

interface RoleInterface
{
    public function getAll();

    public function getById($role);

    public function create(array $attributes);

    public function update(array $attributes, $role);

    public function delete($role);
}