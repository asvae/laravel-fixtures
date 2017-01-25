<?php

namespace Asvae\LaravelFixtures\Examples\Roles;

class FillRolesNewTable extends \Asvae\LaravelFixtures\AbstractFixture
{
    /**
     * Move roles from roles to roles_new table.
     */
    public function run()
    {
        \DB::table('roles_new')->delete();

        $roles = \DB::table('roles')->get();

        $this->getCommand()->line('Total roles: '.count($roles));

        foreach ($roles as $role) {
            $this->createSingleRole($role);
        }
    }

    protected function createSingleRole($role)
    {
        \DB::table('roles_new')->insert([
            'id'         => $role->id,
            'name'       => $role->name,
            'slug'       => $role->slug,
            'created_at' => $role->created_at,
            'updated_at' => $role->updated_at,
        ]);
    }
}