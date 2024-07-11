<?php

namespace App\Console\Commands;

use Filament\Commands\MakeUserCommand as BaseMakeUserCommand;
use Filament\Facades\Filament;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Console\Command;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Attribute\AsCommand;

use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

#[AsCommand(name: 'make:new-filament-user')]
class NewFilamentUser extends Command
{
    protected $description = 'Create a new Filament user with custom validation rules';

    protected $signature = 'make:new-filament-user
                            {--name= : The name of the user}
                            {--email= : A valid and unique email address}
                            {--password= : The password for the user (min. 8 characters)}';

    /**
     * @var array{'name': string | null, 'email': string | null, 'password': string | null}
     */
    protected array $options;

    /**
     * @return array{'name': string, 'email': string, 'password': string}
     */
    protected function getUserData(): array
    {
        $this->options = $this->options();

        $data = [
            'name' => $this->options['name'] ?? text(
                label: 'Name',
                required: true,
            ),

            'email' => $this->options['email'] ?? text(
                label: 'Email address',
                required: true,
            ),

            'password' => $this->options['password'] ?? password(
                label: 'Password',
                required: true,
            ),
        ];

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'email' => ['required',  'email', 'max:100', 'unique:' . static::getUserModel()],
            'password' => ['required', 'string', 'min:8'],
        ], [
            'name.required' => 'Il nome è obbligatorio.',
            'name.string' => 'Il nome deve essere una stringa.',
            'name.min' => 'Il nome deve essere lungo almeno 3 caratteri.',
            'name.max' => 'Il nome non può essere più lungo di 50 caratteri.',
            'email.required' => 'L\'email è obbligatoria.',
            'email.email' => 'L\'indirizzo email deve essere valido.',
            'email.max' => 'L\'email non può essere più lunga di 255 caratteri.',
            'email.unique' => 'Un utente con questo indirizzo email esiste già.',
            'password.required' => 'La password è obbligatoria.',
            'password.string' => 'La password deve essere una stringa.',
            'password.min' => 'La password deve essere lunga almeno 8 caratteri.',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            exit(1);
        }

        $data['password'] = Hash::make($data['password']);

        return $data;
    }

    protected function createUser(): Authenticatable
    {
        return static::getUserModel()::create($this->getUserData());
    }

    protected function getUserModel(): string
    {
        /** @var EloquentUserProvider $provider */
        $provider = $this->getUserProvider();

        return $provider->getModel();
    }

    protected function getAuthGuard(): \Illuminate\Contracts\Auth\Guard
    {
        return Filament::auth();
    }

    protected function getUserProvider(): \Illuminate\Contracts\Auth\UserProvider
    {
        return $this->getAuthGuard()->getProvider();
    }

    public function handle(): int
    {
        if (! Filament::getCurrentPanel()) {
            $this->error('Filament non è ancora stato installato.: php artisan filament:install --panels');
            return static::INVALID;
        }

        $user = $this->createUser();
        $loginUrl = Filament::getLoginUrl();
        $this->info('Success! ' . ($user->getAttribute('email') ?? $user->getAttribute('username') ?? 'You') . " may now log in at {$loginUrl}");

        return static::SUCCESS;
    }
}