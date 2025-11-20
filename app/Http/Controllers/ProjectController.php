<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('projects.index', [
			'projects' => Project::all(),
		]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.new', [
			'companies' => Company::all(),
		]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateOnly = $request->query->has('validate-only');
		$validated = $this->validate($request);

		if ($validateOnly) {
			$request->flash();
			return $this->create();
		}

		$project = Project::create($validated);

		return redirect()
			->route('projects.show', $project)
			->with('flashes', [
				'Project created successfully.' => 'notice'
			]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('projects.show', [
			'project' => $project,
		]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('projects.edit', [
			'project' => $project,
			'companies' => Company::all(),
		]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validateOnly = $request->query->has('validate-only');
		$validated = $this->validate($request, $project);

		if ($validateOnly) {
			$request->flash();
			return $this->edit($project);
		}

		$project->update($validated);
		return redirect()
			->route('projects.show', $project)
			->with('flashes', [
				'Project updated successfully.' => 'notice'
			]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

		return request()->up()->is()
			? response()->withUnpolyEvents(
				events: [
					['type' => 'project:destroyed', 'layer' => 'current'],
				],
				location: route('projects.index'),
			)
			: redirect()->route('projects.index');
    }

	public function suggestName()
	{
		return view('projects.suggest-name', [
			'names' => collect(range(0, 10))
				->map(fn() => str(fake()->catchPhrase())),
		]);
	}

	private function validate(Request $r, ?Project $p = null) : array
	{
		$validated = $r->validate([
			'name' => 'required|string|max:255|unique:projects,name'
				. ($p ? ',' . $p->id : ''),
			'company_id' => 'required|exists:companies,id',
			'budget' => 'required|integer',
		]);
		return $validated;
	}
}
