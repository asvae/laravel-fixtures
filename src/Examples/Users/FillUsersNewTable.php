<?php

namespace Asvae\LaravelFixtures\Examples\Users;

class FillUsersNewTable extends \Asvae\LaravelFixtures\AbstractFixture
{
    /**
     * Move users from old table to new one.
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('users_new')->delete();

        $total = \DB::table('users')->count();
        $this->getCommand()->line("Total users: $total");

        \DB::table('users')->chunk(100, function ($projects) {
            foreach ($projects as $project) {
                $this->createSingleUser($project);
                $this->counter++;
            }

            $this->getCommand()->line($this->counter);
        });
    }

    protected function createSingleUser($user)
    {
        \DB::table('users_new')->insert([
            'id' => $user->id,
            'email' => $user->user_email,
            'password' => $user->password ? $user->password : '',
            'name' => $user->user_name,
            'country_id' => $user->country,
            'comment' => $user->descr,
            'referral_id' => $user->referral_id,
            'referral_alias' => $user->referral_alias,
            'created_at' => $this->getCreatedAt($user),
            'updated_at' => $user->updated_at,
        ]);
    }

    private function getCreatedAt($user){
        if ($user->date_reg && $user->created_at === '1980-01-01 00:00:01'){
            return $user->date_reg;
        }

        return $user->created_at;
    }
}