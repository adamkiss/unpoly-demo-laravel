<x-layout>
	<x-tasks.head :tasks="$tasks" title="Edit task #{{ $task->id }}" />
	<x-forms.task :task="$task"></x-forms.task>
</x-layout>
