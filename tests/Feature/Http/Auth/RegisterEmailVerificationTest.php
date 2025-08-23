<?php  
  
declare(strict_types=1);  
  
use App\Models\User;  
use Filament\Auth\Notifications\VerifyEmail;  
use Filament\Auth\Pages\Register;  
use Filament\Facades\Filament;  
use Illuminate\Support\Facades\Notification;  
use Livewire\Livewire;  
  
it('sends email verification notification when user registers', function (): void {  
    Notification::fake();  
      
    $userPanel = Filament::getPanel('user');  
    Filament::setCurrentPanel($userPanel);  
      
    $userToRegister = User::factory()->make([  
        'email_verified_at' => null,  
    ]);  
      
    Livewire::test(Register::class)  
        ->fillForm([  
            'name' => $userToRegister->name,  
            'email' => $userToRegister->email,  
            'password' => 'password',  
            'passwordConfirmation' => 'password',  
        ])  
        ->call('register');  
      
    Notification::assertSentTimes(VerifyEmail::class, expectedCount: 1);  
      
    $registeredUser = User::query()->where('email', $userToRegister->email)->first();  
    Notification::assertSentTo($registeredUser, VerifyEmail::class);  
});

it('blocks access to panel when email is not verified', function (): void {  
    $unverifiedUser = User::factory()->create([  
        'email_verified_at' => null,  
    ]);  
      
    $userPanel = Filament::getPanel('user');  
    Filament::setCurrentPanel($userPanel);  
      
    $this->actingAs($unverifiedUser);  
      
    // Intentar acceder al panel debería redirigir a verificación  
    $this->get($userPanel->getUrl())  
        ->assertRedirect($userPanel->getEmailVerificationPromptUrl());  
});