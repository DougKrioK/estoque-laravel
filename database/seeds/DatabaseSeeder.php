<?php

use Illuminate\Database\Seeder;
use estoque\Categoria;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // aqui, o frameword preenche o banco vazio, com valores pre definidos
        // $this->call(UsersTableSeeder::class);
        $this->call(CategoriaTableSeeder::class);
    }
}

class CategoriaTableSeeder extends Seeder {
    public function run()
    {
        Categoria::create(['nome' => 'Eletrodomestico']);
        Categoria::create(['nome' => 'Brinquedos']);
        Categoria::create(['nome' => 'Esportes']);
    }
}