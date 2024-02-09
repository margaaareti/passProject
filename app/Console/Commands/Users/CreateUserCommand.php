<?php

namespace App\Console\Commands\Users;

use App\Models\User;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{

    protected $signature = 'users:create';

    public function handle()
    {

        $user = new User();
        $user->name = $this->ask('What is your name?','Владислав');
        $user->last_name = $this->ask('What is your last_name?', 'Ан');
        $user->patronymic = $this->ask('What is your patronymic?', 'Вадимович');
        $user->password = $this->ask('What is your password?', '123456789');
        $user->email = $this->ask('What is your email?','vvan@itmo.ru');
        $user->phone_number = $this->ask('What is your phone number?','89384528803');
        $user->department= $this->ask('What is your department?', 'УФБ');
        $user->isu_number = $this->ask('What is your isu number?','323164');
        $user->save();

        $this->info('Пользователь создан');
    }
}
