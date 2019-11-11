<?php

use Illuminate\Database\Seeder;


class ParticipantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
/*         DB::table('participants')->insert([
            'user_id'      => '278827854',
            'username'      => 'ilianapro',
            'avatar'      => NULL,
            'first_name'    => 'Ильяс',
            'last_name'     => 'Айдар',
            'leader'        => 1,
            'phone'         => '+79523522169',
            'status'        => true,
            'group_id'      => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        ]);
        DB::table('participants')->insert([
            'user_id'      => '663434608',
            'username'      => NULL,
            'avatar'      => NULL,
            'first_name'    => 'Сонунбек',
            'last_name'     => 'Камбаралиев',
            'leader'        => 1,
            'phone'         => NULL,
            'status'        => true,
            'group_id'      => 2,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        ]); */
        factory(App\participant::class, 50)->create();
    }
}
