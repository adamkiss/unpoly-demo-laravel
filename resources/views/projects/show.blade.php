<x-layout>
	<div class="row align-items-center mb-4">
		<div class="col">
			<h2>
				Project #{{ $project->id }}

				@if (request()->up()->context('from_company', false))
					<x-tour-dot>
						<p>
							This overlay reuses the template that is also used for the
							<%= link_to 'Projects', projects_path, 'up-layer': 'root' %> section
							in the main navigation.
						</p>
					</x-tour-dot>
				@endif
			</h2>
		</div>

		<div class="col-sm-auto">
			<x-tour-dot overlay-only>
				<p>Note how the <i>Edit</i> link renders within this overlay.</p>
				<p>Links and forms always update their own layer unless another layer is targeted explicitly.</p>
			</x-tour-dot>

			<a href="{{ route('projects.edit', $project) }}" class="btn btn-primary"
				up-follow="true"
				up-preview="main-spinner"
			>Edit</a>

			<a href="{{ route('projects.destroy', $project) }}" class="btn btn-danger mr-3"
				data-method="delete"
				up-follow="true"
				up-preview="btn-spinner"
				up-confirm="Really delete?">Delete</a>
		</div>
	</div>

	<dl class="my-4">
		<dt>Name</dt>
		<dd><{{ $project->name }}></dd>

		<dt>Company</dt>
		<dd>
			<a href="{{ route('companies.show', $project->company) }}"
				up-layer="swap"
				up-dismiss-location="/projects"
			>{{ $project->company->name }}</a>
			<x-tour-dot><p>This link uses an <code>[up-layer=swap]</code> attribute to replace this overlay instead of stacking on top of it.</p></x-tour-dot>
		</dd>

		<dt>Budget</dt>
		<dd>{{ \Illuminate\Support\Number::currency($project->budget, in: 'EUR', locale: 'DE') }}</dd>
	</dl>
</x-layout>
