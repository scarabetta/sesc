<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        /* admin */
        $admin = App\Rol::where('nombre','administrador')->first();
        
        
        $params_user1 = [
            'name' => 'Rodrigo',
            'titulo' => '',
            'surename' => 'De Salas',
            'email' => 'rodrigo.desalas@buenosaires.gob.ar',
            'password' => bcrypt('{ws?vbJM2vwC(Z4='),
            'rol_id' => $admin->id,
            'vota' => 1,
            'comenta' => 1
        ];
        
        $user1 = new User();
        $user1->fill($params_user1);
        $user1->save();
        
               
	}

    

}
