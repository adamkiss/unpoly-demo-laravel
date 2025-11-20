<div class="task task-item @if($task->done) -done @endif" data-id="{{ $task->id }}" draggable="true">

	@if ($task->done)
		<a href="{{ route('tasks.toggle', $task) }}" data-method="patch" class="task-item--toggle"
			up-target=".task"
			up-preview="unfinish-task">
		</a>
	@else
		<a href="{{ route('tasks.toggle', $task) }}" data-method="patch" class="task-item--toggle"
			up-target=".task"
			up-preview="finish-task">
		</a>
	@endif

	<span class="task-item--text">
		{{ $task->text }}
	</span>
	<a href="{{ route('tasks.edit', $task) }}" class="task-item--edit btn btn-sm btn-secondary"
		up-preview="btn-spinner"
		up-target=".task">
		Edit
	</a>
</div>
