<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Transaction::truncate();
        Product::truncate();
        // \App\Models\User::factory(10)->create();

        Product::factory(50)->create();
        Transaction::factory(5)->create();

        Schema::enableForeignKeyConstraints();

    }
}
