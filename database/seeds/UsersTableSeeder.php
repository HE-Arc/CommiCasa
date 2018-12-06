<?php

use Illuminate\Database\Seeder;
use CommiCasa\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(User::class)->create();

        factory(User::class)->create([
            'name' => 'Julien',
            'email' => 'juju@test.ch',
        ]);

    }
}
