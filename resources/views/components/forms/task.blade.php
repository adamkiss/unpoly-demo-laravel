@props([
	'task',
])
@php
	$new = isset($task) ? false : true;
	$route = $new
		? route('tasks.store')
		: route('tasks.update', $task);
@endphp

<form
	action="{{ $route }}" method="POST"
	class="task task-form" autocomplete="off"
	data-id="start" id="{{ $new ? 'new_task' : "edit_task_".$task->id }}"
	up-target="{{ $new ? '#tasks' : '.task' }}"
	up-preview="{{ $new ? 'add-task, btn-spinner' : 'btn-spinner' }}">

	@csrf
	@method($new ? 'POST' : 'PUT')

	<input type="text" name="text" class="task-form--input form-control"
		placeholder="What needs to be done?" autofocus="{{ $new ? 'autofocus' : '' }}" required value="{{ old('text', $task?->text ?? '') }}">
	@error('text')
		<div class="task-form--error">{{ $message }}</div>
	@enderror

	<button type="submit" class="task-form--save btn btn-primary btn-sm">Save</button>
</form>
