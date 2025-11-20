<x-layout>
	<x-tasks.head :show-tour="true" :tasks="$tasks" title="Tasks" />

	<div id="tasks" class="mt-5">
		<x-forms.task></x-forms.task>

		@foreach ($tasks as $task)
			<x-tasks.item :task="$task"></x-tasks.item>
		@endforeach
	</div>

	<script id="task-preview" type="text/minimustache">
		<div class="task task-item -previewing">
			<span class="task-item--toggle"></span>
			<span class="task-item--text">@{{text}}</span>
		</div>
	</script>
</x-layout>

