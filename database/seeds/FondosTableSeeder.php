<?php

use Illuminate\Database\Seeder;

use App\Fondo;

class FondosTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $params_fondo1 = [
            'nombre' => 'Prodanza',
            'codigo' => 'PRD',
        ];
        
        $user1 = new Fondo();
        $user1->fill($params_fondo1);
        $user1->save();
        
        $params_fondo2 = [
            'nombre' => 'Proteatro',
            'codigo' => 'PRT',
        ];
        
        $user1 = new Fondo();
        $user1->fill($params_fondo2);
        $user1->save();

        $params_fondo3 = [
            'nombre' => 'BAMUSICA',
            'codigo' => 'BAM',
        ];
        
        $user1 = new Fondo();
        $user1->fill($params_fondo3);
        $user1->save();

        $params_fondo4 = [
            'nombre' => 'Mecenazgo',
            'codigo' => 'MZ',
        ];
        
        $user1 = new Fondo();
        $user1->fill($params_fondo4);
        $user1->save();
        
    }

}
