@props([
	'type' => 'info',
	'message' => 'MISSING MESSAGE'
])
@php
	$class = match($type) {
		'notice' => 'alert-success',
		'alert', 'error' => 'alert-danger',
		default => 'alert-info',
	};
@endphp
<div class="alert {{ $class }}" role="alert">
	{{ $message }}
</div>
