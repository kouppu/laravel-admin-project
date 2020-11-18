<?php

namespace App\Repositories\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class EloquentAdminRepository implements AdminRepositoryInterface
{
    protected $eloquent;

    public function __construct(Admin $admin)
    {
        $this->eloquent = $admin;
    }

    public function create(array $attributes): Admin
    {
        return $this->eloquent::create($attributes);
    }

    public function update(array $attributes): bool
    {
        $admin = $this->eloquent::findOrFail($attributes['id']);
        return $admin->update($attributes);
    }

    /**
     * update password
     *
     * @param array $attributes
     * @return boolean
     */
    public function updatePassword(array $attributes): bool
    {
        $admin = $this->eloquent::findOrFail($attributes['id']);
        return $admin->update([
            'password' => Hash::make($attributes['password'])
        ]);
    }
}
