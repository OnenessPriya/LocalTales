<?php

use App\Models\Admin;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Admin::create([
        //     'name'      =>  $faker->name,
        //     'email'     =>  'admin2@admin.com',
        //     'password'  =>  bcrypt('secret'),
        // ]);

        // factory(Admin::class,10)->create();
    }
}
