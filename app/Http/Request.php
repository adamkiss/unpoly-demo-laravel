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

	public function unpoly(): UnpolyRequest {
		return UnpolyRequest::getInstance($this);
	}

	public function up(): UnpolyRequest {
		return $this->unpoly();
	}
}
