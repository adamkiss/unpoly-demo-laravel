<x-layout>
	<h2 class="mb-4">Edit company #{{$company->id}}</h2>

	<x-forms.company :company="$company" :cancel-path="route('companies.show', $company)"/>
</x-layout>
