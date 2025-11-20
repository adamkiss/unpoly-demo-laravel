<x-layout>
	<x-tasks.head :tasks="$tasks" title="Task #{{ $task->id }}" />
	<x-forms.task></x-forms.task>
</x-layout>
