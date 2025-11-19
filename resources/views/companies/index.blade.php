<x-layout>
	<div class="row align-items-center gx-2 mb-4">
		<div class="col">
			<h2>All companies</h2>
		</div>

		<div class="col-sm-auto">
			<x-tour-dot position="left">
				<p>
					The search form has an <code>[up-target="#companies"]</code> attribute.
					This causes the submission results to update the <code>&lt;div id="companies"&gt;</code> element below.
				</p>

				<p>
					The form also has an <code>[up-autosubmit]</code> attribute.
					This automatically submits the user while the user is typing.
				</p>

				<p>
					Forms and links assigned an <code>.up-active</code> class while loading.
					We use this class for the stripe animation on the search field.
				</p>
			</x-tour-dot>

			<form action="/companies" method="GET" class="d-inline-block" up-target="#companies" up-autosubmit="true">
				<input type="search" class="form-control" name="query" placeholder="Search…" autocomplete="off" size="17">
				<span class="search-spinner"></span>
			</form>
		</div>

		<div class="col-sm-auto">
			<x-tour-dot position="left">
				<p>
					The <i>New company</i> button has an <code>[up-layer=new]</code> attribute.
					This causes the link destination to open in an overlay.
				</p>
				<p>
					The button also defines a <i>close condition</i> using an <code>[up-accept-location]</code> attribute.
					This causes the overlay to automatically close when it reaches the URL of a newly created company.
				</p>
				<p>
					The <code>[up-on-accepted]</code> attribute causes the company list below to reload when the overlay closes.
				</p>
			</x-tour-dot>

			<a href="{{ route('companies.create') }}"
				class="btn btn-primary"
				up-layer="new"
				up-placeholder="#form-placeholder"
				up-accept-location="/companies/$id"
				up-on-accepted="up.reload('#companies', {placeholder: '#table-placeholder { rows: 5 }'})"
				up-on-dismissed="up.reload('#companies', { placeholder: '#table-placeholder { rows: 5 }' })"
			>New company</a>
		</div>
	</div>

	<div id="companies">
		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($companies as $i => $company)
					<tr>
						<td>
							<a href="{{ route('companies.show', $company->id) }}"
								up-layer="new"
								up-placeholder="#show-placeholder"
								up-dismiss-event="company:destroyed"
								up-on-dismissed="up.reload('#companies', { placeholder: '#table-placeholder { rows: 5 }' })"
							>{{$company->name}}</a>

							@if ($loop->first)
							<x-tour-dot>
								The link to the company details has an <code>[up-layer=new]</code> attribute.
								This causes the link destination to open in an overlay.
							</x-tour-dot>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</x-layout>
