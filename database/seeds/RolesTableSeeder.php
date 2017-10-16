<?php

use Illuminate\Database\Seeder;

use App\Rol;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        /* Administrador */
        
        $params_rol1 = [
            'nombre' => 'administrador'
        ];
        
        $user1 = new Rol();
        $user1->fill($params_rol1);
        $user1->save();
        
        $params_rol2 = [
            'nombre' => 'coordinador'
        ];
        
        $user1 = new Rol();
        $user1->fill($params_rol2);
        $user1->save();

        $params_rol3 = [
            'nombre' => 'juez'
        ];
        
        $user1 = new Rol();
        $user1->fill($params_rol3);
        $user1->save();
        
    }

}
