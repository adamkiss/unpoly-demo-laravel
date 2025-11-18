<?php

namespace App\Http;

use Illuminate\Http\Request as BaseRequest;

class Request extends BaseRequest {
	public function expectsJson() {
		if ($this->hasHeader('X-Up-Target')) {
			return false;
		}

		return parent::expectsJson();
	}

	public function isUnpolyRequest(): bool {
		return $this->headers->has('X-Up-Version') && $this->headers->has('X-Up-Target');
	}
}
