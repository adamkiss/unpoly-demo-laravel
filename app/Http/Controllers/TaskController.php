<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller {
	/**
	 * Display a listing of the resource.
	 */
	public function index() {
		return view('tasks.index', [
			'tasks' => Task::ordered()
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create() {
		return view('tasks.new', [
			'task' => new Task(),
			'tasks' => Task::ordered()
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request) {
		$validated = $request->validate([
			'text' => 'required|string|max:255',
		]);

		$task = Task::create([
			'text' => $validated['text'],
			'done' => false,
			'position' => 0,
		]);
		Task::reorderAllAfter($task);

		return redirect()->route('tasks.index', $task);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Task $task) {
		return view('tasks.show', [
			'task' => $task,
			'tasks' => Task::ordered()
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Task $task) {
		return view('tasks.edit', [
			'task' => $task,
			'tasks' => Task::ordered()
		]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Task $task) {
		$validated = $request->validate([
			'text' => 'required|string|max:255',
		]);

		$task->text = $validated['text'];
		$task->save();

		return redirect()->route('tasks.show', $task);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Task $task) {}

	/**
	 * Toggle the completion status of the specified task.
	 */
	public function toggle(Task $task) {
		$task->done = !$task->done;
		$task->save();

		return redirect()->back();
	}

	/**
	 * Move a task to a new position.
	 */
	public function move(Request $request, Task $task) {
		$position = match($request->get('reference', false)) {
			'start' => 0,
			false => redirect()->back(),
			default => Task::find($request->get('reference'))->position + 1,
		};

		$task->position = $position;
		$task->save();
		Task::reorderAllAfter($task);

		return redirect()->back();
	}

	/**
	 * Clear all completed tasks.
	 */
	public function clearDone(Request $request) {
		if (Task::where('done', true)->count() === 0) {
			return redirect()->back()->with('flashes', ['No completed tasks to clear.' => 'error']);
		}
		Task::where('done', true)->delete();
		Task::reorderAllAfter();
		return redirect()->back()->with('flashes', ['Cleared completed tasks.' => 'notice']);
	}
}
