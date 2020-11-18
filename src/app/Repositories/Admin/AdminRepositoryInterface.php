<?php

namespace App\Repositories\Admin;

interface AdminRepositoryInterface
{
    public function create(array $attributes);

    public function update(array $attributes);

    public function updatePassword(array $attributes);
}
