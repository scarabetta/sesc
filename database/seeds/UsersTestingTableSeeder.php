<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTestingTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        /* admin */
        $admin = App\Rol::where('nombre','administrador')->first();
        $juez = App\Rol::where('nombre','juez')->first();
        $coordinador = App\Rol::where('nombre','coordinador')->first();
        /* Pro danza */
        $danza = App\Fondo::where('codigo','PRD')->first();
        $musica = App\Fondo::where('codigo','BAM')->first();
        $teatro = App\Fondo::where('codigo','PRT')->first();
        $mecenazgo = App\Fondo::where('codigo','MZ')->first();
        /* Un usuario */
        
        $params_user1 = [
            'name' => 'Patricio',
            'titulo' => 'Director Administrativo',
            'surename' => 'Inzaghi',
            'email' => 'patricio.inzaghi@gmail.com',
            'password' => bcrypt('{ws?vbJM2vwC(Z4='),
            'rol_id' => $admin->id,
            'vota' => 1,
            'comenta' => 1
        ];
        
        $user1 = new User();
        $user1->fill($params_user1);
        $user1->save();
        
               
        /* Otro usuario */        
        $params_user2 = [
            'name' => 'Solange',
            'surename' => 'Blundi',
            'titulo' => 'Director Administrativo',
            'email' => 'solange.blundi@gmail.com',
            'password' => bcrypt('{ws?vbJM2vwC(Z4='),
            'rol_id' => $admin->id,
            'vota' => 1,
            'comenta' => 1
        ];
        
        $user2 = new User();
        $user2->fill($params_user2);
        $user2->save();
        

        // Yet Another usuario 
        
        $params_user3 = [
            'name' => 'Diego',
            'surename' => 'Amden',
            'titulo' => 'Director Administrativo',
            'email' => 'diego@smack.ag',
            'password' => bcrypt('{ws?vbJM2vwC(Z4='),
            'rol_id' => $admin->id,
            'vota' => 1,
            'comenta' => 1
        ];

        $user3 = new User();
        $user3->fill($params_user3);
        $user3->save();
        
        
        $params_user4 = [
            'name' => 'admin',
            'surename' => 'Perez',
            'titulo' => 'Director Administrativo',
            'email' => 'juan@perez.com',
            'password' => bcrypt('{ws?vbJM2vwC(Z4='),
            'rol_id' => $admin->id,
            'vota' => 1,
            'comenta' => 1
        ];

        $user4 = new User();
        $user4->fill($params_user4);
        $user4->save();
        
        /* Un juez */
        
        $params_user1 = [
            'name' => 'Juan',
            'surename' => 'Perez',
            'titulo' => 'Director Administrativo',
            'email' => 'juez@email.com',
            'password' => bcrypt('{ws?vbJM2vwC(Z4='),
            'rol_id' => $juez->id,
            'fondo_id' => $danza->id,
            'vota' => 1,
            'comenta' => 1
        ];
        
        $user1 = new User();
        $user1->fill($params_user1);
        $user1->save();
        
        $params_user1 = [
            'name' => 'Jose',
            'surename' => 'Gonzales',
            'email' => 'juez2@email.com',
            'password' => bcrypt('{ws?vbJM2vwC(Z4='),
            'rol_id' => $juez->id,
            'fondo_id' => $danza->id,
            'vota' => 1,
            'comenta' => 1
        ];
        
        $user1 = new User();
        $user1->fill($params_user1);
        $user1->save();
        
        $params_user1 = [
            'name' => 'Pedro',
            'surename' => 'Solanas',
            'titulo' => 'Director Administrativo',
            'email' => 'juez3@email.com',
            'password' => bcrypt('{ws?vbJM2vwC(Z4='),
            'rol_id' => $juez->id,
            'fondo_id' => $danza->id,
            'vota' => 1,
            'comenta' => 1
        ];
        
        $user1 = new User();
        $user1->fill($params_user1);
        $user1->save();
        
        $params_user1 = [
            'name' => 'Julian',
            'surename' => 'Molina',
            'titulo' => 'Director Administrativo',
            'email' => 'juez4@email.com',
            'password' => bcrypt('{ws?vbJM2vwC(Z4='),
            'rol_id' => $juez->id,
            'fondo_id' => $danza->id,
            'vota' => 1,
            'comenta' => 1
        ];
        
        $user1 = new User();
        $user1->fill($params_user1);
        $user1->save();

        /* Jueces musica */

        $params_user1 = [
            'name' => 'Hernan',
            'surename' => 'Peterson',
            'titulo' => 'Director Administrativo',
            'email' => 'juezm3@email.com',
            'password' => bcrypt('{ws?vbJM2vwC(Z4='),
            'rol_id' => $juez->id,
            'fondo_id' => $musica->id,
            'vota' => 1,
            'comenta' => 1
        ];
        
        $user1 = new User();
        $user1->fill($params_user1);
        $user1->save();
        
        $params_user1 = [
            'name' => 'Alan',
            'surename' => 'Turing',
            'titulo' => 'Director Administrativo',
            'email' => 'juezm4@email.com',
            'password' => bcrypt('{ws?vbJM2vwC(Z4='),
            'rol_id' => $juez->id,
            'fondo_id' => $musica->id,
            'vota' => 1,
            'comenta' => 1
        ];
        
        $user1 = new User();
        $user1->fill($params_user1);
        $user1->save();

        /* Jueces teatro */

        $params_user1 = [
            'name' => 'David',
            'surename' => 'Bowie',
            'titulo' => 'Director Administrativo',
            'email' => 'juezt3@email.com',
            'password' => bcrypt('{ws?vbJM2vwC(Z4='),
            'rol_id' => $juez->id,
            'fondo_id' => $teatro->id,
            'vota' => 1,
            'comenta' => 1
        ];
        
        $user1 = new User();
        $user1->fill($params_user1);
        $user1->save();
        
        $params_user1 = [
            'name' => 'Till',
            'surename' => 'Lindemann',
            'titulo' => 'Director Administrativo',
            'email' => 'juezt4@email.com',
            'password' => bcrypt('{ws?vbJM2vwC(Z4='),
            'rol_id' => $juez->id,
            'fondo_id' => $teatro->id,
            'vota' => 1,
            'comenta' => 1
        ];
        
        $user1 = new User();
        $user1->fill($params_user1);
        $user1->save();
        
        /* Un coordinador */
        
        $params_user1 = [
            'name' => 'Patricio',
            'surename' => 'Fernandez',
            'titulo' => 'Director Administrativo',
            'email' => 'coordinador@email.com',
            'password' => bcrypt('{ws?vbJM2vwC(Z4='),
            'rol_id' => $coordinador->id,
            'fondo_id' => $danza->id,
            'vota' => 1,
            'comenta' => 1
        ];
        
        $user1 = new User();
        $user1->fill($params_user1);
        $user1->save();

        $params_user1 = [
            'name' => 'Florencia',
            'surename' => 'Perez',
            'titulo' => 'Director Administrativo',
            'email' => 'coordinadorm@email.com',
            'password' => bcrypt('{ws?vbJM2vwC(Z4='),
            'rol_id' => $coordinador->id,
            'fondo_id' => $musica->id,
            'vota' => 1,
            'comenta' => 1
        ];
        
        $user1 = new User();
        $user1->fill($params_user1);
        $user1->save();

        $params_user1 = [
            'name' => 'Agustina',
            'surename' => 'Fernandez',
            'titulo' => 'Director Administrativo',
            'email' => 'coordinadort@email.com',
            'password' => bcrypt('{ws?vbJM2vwC(Z4='),
            'rol_id' => $coordinador->id,
            'fondo_id' => $teatro->id,
            'vota' => 1,
            'comenta' => 1
        ];
        
        $user1 = new User();
        $user1->fill($params_user1);
        $user1->save();
    
	   $params_user1 = [
            'name' => 'Aime',
            'surename' => 'Kubrick',
            'titulo' => 'Director Administrativo',
            'email' => 'coordinadormece@email.com',
            'password' => bcrypt('{ws?vbJM2vwC(Z4='),
            'rol_id' => $coordinador->id,
            'fondo_id' => $mecenazgo->id,
            'vota' => 1,
            'comenta' => 1
        ];

        $user1 = new User();
        $user1->fill($params_user1);
        $user1->save();

        $params_user1 = [
            'name' => 'Leos',
            'surename' => 'Carax',
            'titulo' => 'Directorio',
            'email' => 'juezmece@email.com',
            'password' => bcrypt('{ws?vbJM2vwC(Z4='),
            'rol_id' => $juez->id,
            'fondo_id' => $mecenazgo->id,
            'vota' => 1,
            'comenta' => 1
        ];

        $user1 = new User();
        $user1->fill($params_user1);
        $user1->save();

        $params_user1 = [
            'name' => 'David',
            'surename' => 'Lynch',
            'titulo' => 'Directorio',
            'email' => 'juezmece2@email.com',
            'password' => bcrypt('{ws?vbJM2vwC(Z4='),
            'rol_id' => $juez->id,
            'fondo_id' => $mecenazgo->id,
            'vota' => 1,
            'comenta' => 1
        ];

        $user1 = new User();
        $user1->fill($params_user1);
        $user1->save();

	}

    

}
