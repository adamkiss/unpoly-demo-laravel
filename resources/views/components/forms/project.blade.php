@props([
	'project',
	'companies' => [],
	'cancelPath' => null,
])
@php
	$edit = isset($company);
	$project = $project ?? null;
	$route = $edit
		? route('projects.update', $project)
		: route('projects.store');
@endphp


<form action="{{ $route }}"
method="POST"
	up-submit
	up-disable
	up-validate up-validate-url="{{ $route }}?validate-only" up-validate-method="POST"
	up-preview="btn-spinner">

	@method($edit ? 'PUT' : 'POST')
	@csrf

	<div class="form-group">
		<label for="name">Name</label>
		<div class="input-group">
			<input type="text" name="name" id="name" class="form-control" value="{{ old('name', $project?->company?->name) }}">
			<span class="input-group-text">
				<x-tour-dot>
					<p>
						The button opens a popup with suggestions for a project name.
					</p>
					<p>
						When a suggestion is clicked, the choice is communicated
						back to the project form via a custom <code>name:select</code> event.</p>
					<p>
						The <i>Suggest name</i> link has an <code>[up-on-accepted]</code>
						attribute that copies the suggestion into the project form.
					</p>
				</x-tour-dot>
			</span>
			<a href="{{ route('projects.suggest-name') }}"
				class="btn btn-outline-secondary"
				up-preview="popup-spinner"
				up-layer="new popup"
				up-size="large"
				up-align="right"
				up-accept-event="name:select"
				up-on-accepted="up.fragment.get('#name').value = value.name"
			>Suggest name</a>
		</div>
		@error('name')
			<small class="form-text form-error">{{ $message }}</small>
		@enderror
	</div>

	@unless(request()->up()->context('from_company', false))
		<div class="form-group">
			<label for="company_id">Company</label>
			<div class="input-group">
				<select name="company_id" id="company_id" class="form-control">
					<option value="">&lt;Select company&gt;</option>
					@foreach ($companies as $company)
						<option value="{{ $company->id }}" {{ old('company_id', $project?->company?->id) == $company->id ? 'selected' : '' }}>
							{{ $company->name }}
						</option>
					@endforeach
				</select>
				<span class="input-group-text">
					<x-tour-dot>
						<p>
							A new company can be created in an overlay while the incomplete project form
							stays open in the background.
						</p>
						<p>
							The <i>New company</i> also defines a <i>close condition</i> using an <code>[up-accept-location]</code> attribute.
							This causes the overlay to automatically close when it reaches the URL of a newly created company.
						</p>

						<p>
							When a company was created successfully, the overlay is automatically closed.
							The project form reloads the company select box so the new company appears
							as an option.
						</p>
					</x-tour-dot>
				</span>

				<a href="{{ route('companies.create') }}"
					class="btn btn-outline-secondary"
					up-placeholder="#form-placeholder"
					up-layer="new"
					up-accept-location="/companies/$id"
					up-on-accepted="up.validate('#company-form-group', { params: { 'project[company_id]': value.id }, placeholder: '#form-placeholder' })"
				>New company</a>
			</div>
			@error('company_id')
				<small class="form-text form-error">{{ $message }}</small>
			@enderror
		</div>
	@else
		<input type="hidden" name="company_id" value="{{ request()->up()->context('from_company') }}">
	@endunless


	<div class="form-group">
		<label for="budget">Budget</label>
		<div class="input-group">
			<input type="text" name="budget" id="budget" class="form-control" value="{{ old('budget', $project?->budget) }}">
			<span class="input-group-append">
				<span class="input-group-text">€</span>
			</span>
		</div>
		@error('budget')
			<small class="form-text form-error">{{ $message }}</small>
		@enderror
	</div>

	<div class="d-flex align-items-center mt-4">
		<div class="flex-grow-1">
			<button type="submit" class="btn btn-primary">Save</button>

			@unless($edit)
				<x-tour-dot overlay-only>
					<p>Saving an invalid form will re-render validation errors in the same overlay.</p>
					<p>Links and forms always render in the same layer unless another layer is targeted explicitly.</p>
				</x-tour-dot>
			@endunless
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
