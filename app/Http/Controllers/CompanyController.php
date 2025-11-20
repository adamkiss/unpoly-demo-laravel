<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CompanyController extends Controller {
	/**
	 * Display a listing of the resource.
	 */
	public function index() {
		return view('companies.index', [
			'companies' => Company::all(),
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create() {
		return view('companies.new', []);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request) {
		$validateOnly = Arr::has($request->query(), 'validate-only');
		$validated = $this->validate($request);

		if ($validateOnly) {
			$request->flash();
			return $this->create();
		}

		$company = Company::create($validated);

		return redirect()
			->route('companies.show', $company)
			->with('flashes', [
				'Company created successfully.' => 'notice'
			]);
	}

	/**
	 * Validate form without storing the company for live validation
	 */
	public function liveValidate(Request $request): void {
		$this->validate($request);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Company $company) {
		return view('companies.show', [
			'company' => $company,
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Company $company) {
		return view('companies.edit', [
			'company' => $company,
		]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Company $company) {
		$validateOnly = Arr::has($request->query(), 'validate-only');
		$validated = $this->validate($request, $company);

		if ($validateOnly) {
			$request->flash();
			return $this->edit($company);
		}

		$company->update($validated);

		return redirect()
			->route('companies.show', $company)
			->with('flashes', [
				'Company updated successfully.' => 'notice'
			]);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Company $company) {
		$company->delete();

		return request()->up()->is()
			? response()->withUnpolyEvents(
				events: [
					['type' => 'company:destroyed', 'layer' => 'current'],
				],
				location: route('companies.index'),
			)
			: redirect()->route('companies.index');
	}

	public function validate(Request $request, ?Company $ignore = null): array {
		$validated = $request->validate([
			'name' => 'required|string|max:255|unique:companies,name'
				. ($ignore ? ',' . $ignore->id : ''),
			'address' => 'required|string',
		]);
		return $validated;
	}
}
