<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('withUnpolyEvents', function (array $events = [], ?string $location = null) {
			$r = Response::make(headers: [
				'X-Up-Events' => json_encode($events),
			]);
			if ($location) {
				$r->headers->set('X-Up-Location', $location);
			}
			return $r;
		});
    }
}
