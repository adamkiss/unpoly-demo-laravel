<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Webstronauts\Unpoly\Unpoly;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Register any application services.
	 */
	public function register(): void {
		App::singleton(Unpoly::class, function () {
			return new Unpoly();
		});
		App::bind('unpoly', function () {
			return App::make(Unpoly::class);
		});
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void {
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
