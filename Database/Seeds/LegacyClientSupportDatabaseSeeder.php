<?php
namespace App\Modules\LegacyClientSupport\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LegacyClientSupportDatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('App\Modules\LegacyClientSupport\Database\Seeds\FoobarTableSeeder');

        Model::reguard();

	}

}
