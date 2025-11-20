<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Task extends Model {
	/** @use HasFactory<\Database\Factories\TaskFactory> */
	use HasFactory;

	protected $fillable = [
		'text',
		'done',
		'position',
	];

	public static function ordered(): Collection {
		return Task::orderBy('position')->get();
	}

	public static function reorderAllAfter(null|int|Task $task = null): void {
		$position = ($task instanceof Task ? $task->position : $task) ?? 0;
		$tasks = Task::where('position', '>=', $position)
			->when($task instanceof Task, fn ($query) => $query->where('id', '!=', $task->id))
			->orderBy('position')
			->get();

		foreach ($tasks as $t) {
			$position++;
			$t->position = $position;
			$t->save();
		}
	}
}
