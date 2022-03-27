<?php

namespace App\Interfaces;

interface ExpenseInterface
{
    public function getAll($user);

    public function getById($expense);

    public function create(array $attributes, $user);

    public function update(array $attributes, $expense);

    public function delete($expense);

    public function getRecent($user);
}
