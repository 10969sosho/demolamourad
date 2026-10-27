<?php

namespace App\Filament\Pages\Concerns;

use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\Component;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;

trait InteractsWithSiteSettings
{
    use InteractsWithFormActions;

    public ?array $data = [];

    /** @return array<string, string> */
    abstract protected function settingFields(): array;

    /** @return array<Component> */
    abstract protected function getFormSchema(): array;

    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getFormSchema())
            ->statePath('data');
    }

    public function mount(): void
    {
        $content = SiteSetting::content();
        $state = [];

        foreach ($this->settingFields() as $field => $path) {
            $state[$field] = data_get($content, $path);
        }

        $this->form->fill($state);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($this->settingFields() as $field => $path) {
            SiteSetting::set($path, $data[$field] ?? null);
        }

        Notification::make()
            ->success()
            ->title('Pengaturan berhasil disimpan')
            ->send();
    }

    /** @return array<Action> */
    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Pengaturan')
                ->icon('heroicon-o-check')
                ->submit('save'),
        ];
    }
}
