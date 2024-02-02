<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(LogViewerSeeder::class);
        $this->call(SidebarMenuSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CoinTypeSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(VatSeeder::class);
        $this->call(BankAccountSeeder::class);
        $this->call(BusinessSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(WorkerSeeder::class);
        $this->call(CustomerSeeder::class);


        $this->call(CountrySeederDat::class);
        $this->call(CategorySeederDat::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(CoinTypeSeederDat::class);
        $this->call(VatSeederDat::class);
        $this->call(PaymentMethodSeederDat::class);

        $this->call(BusinessSeederDat::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    }

}
