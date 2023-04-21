<?php

namespace App\Console\Commands;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:admin {--u|username=} {--e|email=} {--p|password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Registers an account with Admin privileges';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $username = $this->option("username");
        if ($username === null) $username = $this->ask('Username');
        $email = $this->option('email');
        if ($email === null) $email = $this->ask('Email');
        $password = $this->option('password');
        if ($password === null) $password = $this->secret('Password');

        $validator = Validator::make([
            'name' => $username,
            'email' => $email,
            'password' => $password,
        ], [
            "name" => "required|max:255",
            "email" => "required|max:255|unique:users,email|email",
            "password" => "required|min:8|max:255",
        ]);
        if ($validator->fails()) {
            $this->info('Admin User not registered. See error messages below:');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return Command::INVALID;
        }
        $data = ["name" => $username,"email"=>$email,"password" => $password];
        $data["password"] = Hash::make($data["password"]);
        $data["role"] = UserRoleEnum::Admin;
        $user = User::create($data);
        UserSettings::create(["user_id" => $user->id]);
        $this->info('Admin User is successfully registered');
        return Command::SUCCESS;
    }
}
