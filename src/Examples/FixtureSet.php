<?php

namespace Asvae\LaravelFixtures\Examples;

use Asvae\LaravelFixtures\Examples\Articles\FillArticlesTable;
use Asvae\LaravelFixtures\Examples\Roles\BindRolesNewToUsersNew;
use Asvae\LaravelFixtures\Examples\Roles\FillRolesNewTable;
use Asvae\LaravelFixtures\Examples\Users\FillUsersNewTable;

class FixtureSet extends \Asvae\LaravelFixtures\AbstractFixture
{
    /**
     * This is our main fixture.
     */
    public function run()
    {
        /**
         * We're going to be explicit here.
         *
         * Users are independent.
         * Articles require users.
         * Roles require users.
         * Role binds require both users and roles.
         */

        $this->runArray([
            'users'    => FillUsersNewTable::class,
            'articles' => FillArticlesTable::class,
            'roles'    => [
                FillRolesNewTable::class,
                BindRolesNewToUsersNew::class,
            ],
        ]);
    }
}