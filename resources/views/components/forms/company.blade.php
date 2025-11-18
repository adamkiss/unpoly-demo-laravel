@props([
	'company' => null,
	'cancelPath' => null,
])
@php
	$edit = isset($company);
@endphp

<form action="{{ $edit ? route('companies.update', $company) : route('companies.store') }}" method="POST"
	up-submit
	up-disable
	up-preview="btn-spinner">

	@method($edit ? 'PUT' : 'POST')
	@csrf

	<div class="form-group">
		<label for="name">Name</label>
		<input type="text" name="name" id="name" class="form-control" value="{{ old('name', $company?->name) }}">
		@error('name')
			<small class="form-text form-error">{{ $message }}</small>
		@enderror
	</div>

	<div class="form-group">
		<label for="address">Address</label>
		<textarea name="address" id="address" class="form-control" rows="6">{{ old('address', $company?->address) }}</textarea>
		@error('address')
			<small class="form-text form-error">{{ $message }}</small>
		@enderror
	</div>

	<div class="d-flex align-items-center mt-4">
		<div class="flex-grow-1">
			<button type="submit" class="btn btn-primary">Save</button>

			@if (!$edit)
				<x-tour-dot overlay-only>
					<p>Saving an invalid form will re-render validation errors in the same overlay.</p>
					<p>Links and forms always render in the same layer unless another layer is targeted explicitly.</p>
				</x-tour-dot>
			@endif
		</div>

		<div>
			@if (isset($cancelPath))
				<a href="{{ $cancelPath }}" class="btn btn-outline-secondary"
					up-follow
					up-preview="main-spinner"
				>Cancel</a>
			@endif
		</div>
	</div>
</form>
