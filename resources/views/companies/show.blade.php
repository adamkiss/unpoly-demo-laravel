<x-layout>
	<div class="row align-items-center mb-4">
		<div class="col">
			<h2>Company #{{ $company->id }}</h2>
		</div>

		<div class="col-sm-auto">
			<x-tour-dot overlay-only>
				<p>Note how the <i>Edit</i> link renders within this overlay.</p>
				<p>Links and forms always update their own layer unless another layer is targeted explicitly.</p>
			</x-tour-dot>

			<a href="{{ route('companies.edit', $company) }}" class="btn btn-primary" up-follow up-preview="main-spinner">Edit</a>
			<a href="{{ route('companies.destroy', $company) }}" data-method="delete" class="btn btn-danger" up-follow up-confirm="Really delete?" up-preview="btn-spinner">Delete</a>
		</div>
	</div>

	<dl>
		<dt>Name</dt>
		<dd>{{ $company->name }}</dd>
		<dt>Address</dt>
		<dd>
			@unless (empty($company->address))
				{{ $company->address }}
			@else
				&mdash;
			@endunless
		</dd>
	</dl>

	<div class="row mb-2">
		<div class="col">
			<h4>Projects</h4>
		</div>

		<div class="col-sm-auto">
			<div class="col-sm-auto">
				<x-tour-dot position="left">
					<p>
						This button re-uses the project form that we already built for the <i>Projects</i> tab.
					</p>

					<p>
						When a new project was created, the overlay closes and the project list is reloaded.
					</p>
				</x-tour-dot>

				<a
					href="{{ route('projects.create', $company->id) }}" class='btn btn-primary btn-sm'
					up-layer='new',
					up-placeholder='#form-placeholder',
					up-accept-location='/projects/\d+',
					up-on-accepted="up.reload('#projects', { placeholder: '#table-placeholder { rows: 5 }' })",
					up-context='{"from_company": true }'
				>Add project</a>
			</div>
		</div>
	</div>

	<div id="projects">
		@if($company->projects()->count() > 0)
			<table class="table table-sm">
				<thead>
					<th>Name</th>
					<th style="text-align: right">Budget in €</th>
				</thead>
				<tbody>
					@foreach ($company->projects as $i => $project)
						<tr>
							<td>
								<a href="{{ route('projects.show', $project) }}"
									up-layer="new"
									up-placeholder="#show-placeholder"
									up-dismiss-event="project:destroyed"
									up-on-dismissed="up.reload('#projects', { placeholder: '#table-placeholder { rows: 5 }' })"
									up-context='{"from_company": true }'
								>{{ $project->name }}</a>

								@if($loop->first)
									<x-tour-dot overlay-only>
										<p>Opening the project will open another modal over this one.</p>
										<p>Overlays can be stacked infinitely.</p>
									</x-tour-dot>
								@endif
							</td>
							<td align="right">
								{{ \Illuminate\Support\Number::currency($project->budget, in: 'EUR', locale: 'DE') }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p>
				This company has no projects yet.
			</p>
		@endif
	</div>

</x-layout>
