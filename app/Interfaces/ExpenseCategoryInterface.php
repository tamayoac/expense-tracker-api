<?php
namespace App\Interfaces;

interface ExpenseCategoryInterface
{
    public function getAll();

    public function getById($category);

    public function create(array $attributes);

    public function update(array $attributes, $category);

    public function delete($category);
}