<?php

namespace Asvae\LaravelFixtures\Examples\Roles;

class BindRolesNewToUsersNew extends \Asvae\LaravelFixtures\AbstractFixture
{
    /**
     * Bind roles to users.
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $total = \DB::table('role_user')->count();
        $this->getCommand()->line("Total role_user: $total");

        \DB::table('role_user')->chunk(100, function ($roleUsers) {
            foreach ($roleUsers as $roleUser) {
                $this->bindRoleToUser($roleUser);
                $this->counter++;
            }

            $this->getCommand()->line($this->counter);
        });
    }

    protected function bindRoleToUser($roleUser)
    {
        \DB::table('users_new')
            ->where('id', $roleUser->user_id)
            ->update(['role_id' => $roleUser->role_id]);
    }
}