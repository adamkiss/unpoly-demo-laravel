<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webstronauts\Unpoly\Unpoly;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('companies.index', [
            'companies' => Company::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.new', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
		$validated = $request->validate([
			'name' => 'required|string|max:255',
			'address' => 'nullable|string',
		]);

		$company = Company::create($validated);

		return redirect()->route('companies.show', $company);

    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('companies.show', [
			'company' => $company,
		]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
		$company->delete();

		return new Response(headers: [
			'X-Up-Events' => json_encode([
				[
					'type' => 'company:destroyed',
					'layer' => 'current'
				]
			]),
			'X-Up-Location' => route('companies.index'),
		]);
    }
}
