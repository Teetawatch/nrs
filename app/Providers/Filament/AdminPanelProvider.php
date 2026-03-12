<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::hex('#1E3A5F'),
            ])
            ->brandName(config('app.name') . ' — Admin')
            ->renderHook(
                'panels::head.end',
                fn (): string => '<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700;800&family=Sarabun:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">'
            )
            ->renderHook(
                'panels::styles.after',
                fn (): string => '<style>
                    :root {
                        --font-heading: "Kanit", sans-serif;
                        --font-body: "Sarabun", sans-serif;
                    }
                    body { font-family: var(--font-body) !important; }
                    h1, h2, h3, h4, h5, h6,
                    .filament-page-heading,
                    .filament-header-heading,
                    .fi-ta-title { font-family: var(--font-heading) !important; }
                    .fi-ta-content,
                    .filament-forms-text-input,
                    .filament-forms-textarea,
                    .filament-tables-text-column { font-family: var(--font-body) !important; }
                    .filament-tables-container th,
                    .filament-tables-container td { font-family: var(--font-body) !important; }
                </style>'
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
