<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Page;
use LaraZeus\Qr\Components\Qr;

class QrCodeGenerator extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-qr-code';

    protected static string $view = 'filament.pages.qr-code-generator';

    protected static ?int $navigationSort = 2;

    public ?array $data;

    public string $qrcode;

    public function mount(): void
    {
        $this->form->fill();
    }

    public static function getNavigationLabel(): string
    {
        return 'QR maker';
    }

    public function getTitle(): string
    {
        return 'QR maker';
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Section::make()
                    ->schema([
                        ...\LaraZeus\Qr\Facades\Qr::getFormSchema('text', 'text-options'),
                    ]),
            ]);
    }
}
