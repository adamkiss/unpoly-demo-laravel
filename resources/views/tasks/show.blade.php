<x-layout>
	<x-tasks.head :tasks="$tasks" title="Task #{{ $task->id }}" />
	<x-tasks.item :task="$task"></x-tasks.item>
</x-layout>
