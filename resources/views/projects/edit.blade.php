<x-layout>
	<h2 class="mb-4">Edit project #{{ $project->id }}</h2>

	<x-forms.project :companies="$companies" :project="$project" :cancel-path="route('projects.show', $project)" />
</x-layout>
