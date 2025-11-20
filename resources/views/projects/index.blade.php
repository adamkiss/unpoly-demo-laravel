<x-layout>
	<div class="row align-items-center mb-4">
		<div class="col">
			<h2>All projects</h2>
		</div>

		<div class="col-sm-auto">
			<x-tour-dot position="left">
				<p>
					The <i>New project</i> button has an <code>[up-layer=new]</code> attribute.
					This causes the link destination to open in an overlay.
				</p>
				<p>
					The button also defines a <i>close condition</i> using an <code>[up-accept-location]</code> attribute.
					This causes the overlay to automatically close when it reaches the URL of a newly created project.
				</p>
				<p>
					The <code>[up-on-accepted]</code> attribute causes the project list below to reload when the overlay closes.
				</p>
			</x-tour-dot>

			<a href="{{ route('projects.create') }}" class="btn btn-primary"
				up-placeholder="#form-placeholder"
				up-layer="new"
				up-accept-location="/projects/$id"
				up-on-accepted="up.reload('#projects', { placeholder: '#table-placeholder' })">
				New project
			</a>
		</div>
	</div>

	<div id="projects">
		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Company</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($projects as $i => $project)
				<tr>
					<td>
						<a href="{{ route('projects.show', $project) }}"
							up-layer="new"
							up-accept-event="project:destroyed project:updated"
							up-on-accepted="up.reload('#projects', { placeholder: '#table-placeholder' })"
							up-placeholder="#show-placeholder">
							{{ $project->name }}
						</a>
					</td>
					<td>
						{{ $project->company->name }}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</x-layout>
