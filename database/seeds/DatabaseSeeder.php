<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

    $this->call('RolesTableSeeder');
    $this->call('FondosTableSeeder');
    $this->call('TipoVotacionesTableSeeder');
    $this->call('VotacionOpcionesTableSeeder');
    $this->call('LineasTableSeeder');
    //$this->call('UsersTableSeeder');
    $this->call('UsersTestingTableSeeder');
    $this->call('ExpedientesTableSeeder');
	}

}
