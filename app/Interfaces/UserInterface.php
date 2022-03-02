<?php
namespace App\Interfaces;

interface UserInterface
{
    public function getAll();

    public function getById($user);

    public function create(array $attributes);

    public function update(array $attributes, $user);

    public function delete($user);
}