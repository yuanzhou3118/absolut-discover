<?php

use App\BackendUser;
use Illuminate\Database\Seeder;

class BackendUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        try {
            DB::statement('TRUNCATE TABLE backend_users');

            $backend_user = new BackendUser();

            $backend_user->account = 'admin';
            $backend_user->pwd = 'Qaz123*()';
            $backend_user->name = 'admin';
            $backend_user->status = true;

            $backend_user->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }
}
