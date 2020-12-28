<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $setting = $this->findSetting('tishmax@mail.ru');
        if (!$setting->exists) {
            $setting->fill([
                'name' => 'Admin',
                'role_id' => 1,
                'password' =>  Hash::make('bcRp45z4AtMgNMYE')
            ])->save();
        }

    }

    /**
     * [setting description].
     *
     * @param [type] $key [description]
     *
     * @return User|\Illuminate\Database\Eloquent\Model [type] [description]
     */
    protected function findSetting($key)
    {
        return User::firstOrNew(['email' => $key]);
    }
}
