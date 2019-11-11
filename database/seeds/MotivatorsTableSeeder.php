<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MotivatorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('motivators')->insert([
             [
                'motivation'      => 'Люди без ног и без рук берут золото Паралимпиады, а двуногие и двурукие жалуются на жизнь.',
                'participant'     => 'iSmarty PRO',
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now()
                
             ],
             [
                'motivation'      => 'Алкоголь развлечение бедных, Наркотики — слабых, Спорт — для сильных!',
                'participant'     => 'iSmarty PRO',
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now()
             ],
             [
                'motivation'      => 'Пусть я после занятий спортом обессиленная, уставшая, но в то же время, какой заряд бодрости дают эти тренировки!',
                'participant'     => 'iSmarty PRO',
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now()
             ],
             [
                'motivation'      => 'Сделай сегодня сколько сможешь — завтра сможешь ещё больше.',
                'participant'     => 'iSmarty PRO',
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now()
             ],
             [
                'motivation'      => 'Мы перестаем тренироваться не потому что становимся старше – мы стареем из-за того что перестаем тренироваться.',
                'participant'     => 'iSmarty PRO',
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now()
             ],
             [
                'motivation'      => 'Главное — желание заняться спортом, а способ всегда найдется!',
                'participant'     => 'iSmarty PRO',
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now()
             ],
             [
                'motivation'      => 'Победа не дает силу. Силу дает борьба. Если ты борешься и не сдаешься — это и есть сила.',
                'participant'     => 'iSmarty PRO',
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now()
             ]
             ]);
    }
}
