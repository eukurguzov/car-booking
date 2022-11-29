<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Order;
use App\Models\Size;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $carSizes = ['Small', 'Medium', 'XXL'];

         User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);

        foreach ($carSizes as $size) {
            Size::create(['name' => $size]);
        }

        Order::factory()->count(5)->create();
    }
}
