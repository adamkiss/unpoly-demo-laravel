<table class="table">
	<thead>
	<tr>
		<th><x-placeholders.span>Name</x-placeholders.span></th>
		<th><x-placeholders.span>Company</x-placeholders.span></th>
	</tr>
	</thead>

	<tbody>
		@for ($i = 1; $i <= 10; $i++)
		<tr>
			<td><x-placeholders.span>{{ $i }}</x-placeholders.span></td>
			<td>{{ fake()->company() }}</td>
		</tr>
		@endfor
	</tbody>
</table>
