<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class AddLocalTestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if ($this->isDataAlreadyGiven()) {
            return;
        }

        if (App::environment() === 'local') {
            User::create([
                'name' => 'Chang180',
                'email' => 'test@test.at',
                'password' => bcrypt('password'),
            ]);
        }

    }

    private function isDataAlreadyGiven(): bool
    {
        return User::where('name', 'chang180')->exists();
    }
}
