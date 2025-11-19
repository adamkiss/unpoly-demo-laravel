<?php

namespace App\Http;

use SplObjectStorage;

class UnpolyRequest {
	private static SplObjectStorage $instances;

	public static function getInstance(?Request $request = null): UnpolyRequest {
		$request ??= request();
		static::$instances ??= new SplObjectStorage();

		if (static::$instances->offsetExists($request) === false) {
			self::$instances->offsetSet($request, new UnpolyRequest($request));
		}
		return self::$instances->offsetGet($request);
	}

	public function __construct(
		private Request $request
	) {}

	public function is(): bool {
		return $this->request->headers->has('X-Up-Version')
			&& $this->request->headers->has('X-Up-Target');
	}

	public function context(string $key, mixed $default = null): mixed {
		return app('unpoly')->getContext($this->request)[$key] ?? $default;
	}

}
