<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUser extends Command
{
    protected $signature = 'create:user
                            {--name= : The name of the user}
                            {--email= : A valid and unique email address}
                            {--password= : The password for the user (min. 8 characters)}';

    protected $description = 'Create a new user with Jetstream validation rules and custom error messages';

    public function handle()
    {
        $this->line('Creating a new user...');
        $this->newLine();

        // Get and validate name
        $name = $this->option('name') ?? $this->askValid(
            'Name', 
            'name', 
            ['required', 'string', 'min:3', 'max:50']
        );

        // Get and validate email
        $email = $this->option('email') ?? $this->askValid(
            'Email address', 
            'email', 
            ['required', 'email', 'max:100', 'unique:users,email']
        );

        // Get and validate password
        $password = $this->option('password') ?? $this->askValid(
            'Password', 
            'password', 
            ['required', 'string', 'min:8'], 
            true // Secret input for password
        );

        // Create the user
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info('User created successfully!');
    }

    /**
     * Prompt the user for input and validate the response.
     *
     * @param string $question
     * @param string $field
     * @param array $rules
     * @param bool $secret
     * @return mixed
     */
    protected function askValid(string $question, string $field, array $rules, bool $secret = false)
    {
        $value = null;

        do {
            if ($secret) {
                $value = $this->secret($question);
            } else {
                $value = $this->ask($question);
            }

            $validator = Validator::make(
                [$field => $value], 
                [$field => $rules],
                [
                    'name.required' => 'Il nome è obbligatorio.',
                    'name.string' => 'Il nome deve essere una stringa.',
                    'name.min' => 'Il nome deve essere lungo almeno 3 caratteri.',
                    'name.max' => 'Il nome non può essere più lungo di 50 caratteri.',
                    'email.required' => 'L\'email è obbligatoria.',
                    'email.email' => 'L\'indirizzo email deve essere valido.',
                    'email.max' => 'L\'email non può essere più lunga di 100 caratteri.',
                    'email.unique' => 'Un utente con questo indirizzo email esiste già.',
                    'password.required' => 'La password è obbligatoria.',
                    'password.string' => 'La password deve essere una stringa.',
                    'password.min' => 'La password deve essere lunga almeno 8 caratteri.',
                ]
            );

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    $this->error($error);
                }
            }

        } while ($validator->fails());

        return $value;
    }
}