@php
	$showTour ??= false;
@endphp

<div class="row align-items-center gx-3 mb-4">
	<div class="col">
		<h2>
			{{ $title }}
			@if($showTour)
			<x-tour-dot>
				<p>
					This screen shows many task boxes with the same selector
					(<code>&lt;div class="task"&gt;</code>).
				</p>
				<p>
					Note how changing a task will only update a single task box.
				</p>
			</x-tour-dot>
			@endif
		</h2>
	</div>

	<div class="col-sm-auto" id="open-task-count" up-hungry>
		{{ $tasks->count() }} {{ Str::of('task')->plural($tasks->count()) }} left!
	</div>

	<div class="col-sm-auto">
		@if ($showTour)
			<x-tour-dot position="left">
				<p>
					The <i>Clear done</i> button has an <code>[up-target=".tasks"]</code> attribute.
					Clicking the link will only update the <code>&lt;div class="tasks"&gt;</code> element.
				</p>
				<p>
					Other HTML from the server response is discarded.
				</p>
			</x-tour-dot>
		@endif

		<a href="{{ route('tasks.clear-done') }}" data-method="delete" class="btn btn-secondary"
			up-target=".tasks"
			up-preview="btn-spinner, clear-tasks">
			Clear done
		</a>
	</div>
</div>
