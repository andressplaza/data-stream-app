<?php  
  
declare(strict_types=1);  
  
namespace App\Filament\User\Pages;  
  
use App\Actions\UpdateUserProfileAction;  
use Filament\Auth\Pages\EditProfile as BaseEditProfile;  
use Filament\Forms\Components\TextInput;  
use Filament\Schemas\Schema;  
use Illuminate\Database\Eloquent\Model;  
  
final class Profile extends BaseEditProfile  
{  
    protected string $view = 'filament.user.pages.profile';  
  
    public function form(Schema $schema): Schema  
    {  
        return $schema  
            ->components([  
                $this->getNameFormComponent(),  
                $this->getEmailFormComponent(),  
                $this->getPasswordFormComponent(),  
                $this->getPasswordConfirmationFormComponent(),  
  
                TextInput::make('shopify_store_url')  
                    ->label('Shopify Store URL')  
                    ->url()  
                    ->maxLength(255),  
  
                TextInput::make('facebook_pixel_id')  
                    ->label('Facebook Pixel ID')  
                    ->maxLength(255),  
  
                // Campos con funcionalidad mostrar/ocultar  
                TextInput::make('shopify_api_token')  
                    ->label('Shopify API Token')  
                    ->password()  
                    ->revealable()  
                    ->maxLength(255),  
  
                TextInput::make('facebook_pixel_token')  
                    ->label('Facebook Pixel Token')  
                    ->password()  
                    ->revealable()  
                    ->maxLength(255),  
            ]);  
    }  
  
    protected function handleRecordUpdate(Model $record, array $data): Model  
    {  
        $action = app(UpdateUserProfileAction::class);  
  
        return $action->handle($record, $data);  
    }  
}