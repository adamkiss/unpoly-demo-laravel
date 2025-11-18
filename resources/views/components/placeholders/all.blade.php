<template id="index-placeholders">
	<div class="placeholder-wave">
		<div class="row align-items-center mb-4">
			<div class="col">
			<h2><x-placeholders.span>All records</x-placeholders.span></h2>
			</div>
			<div class="col-sm-auto">
			<span class="btn placeholder">New record</span>
			</div>
		</div>

		<x-placeholders.table-inner />
	</div>
</template>

<template id="table-placeholder">
	<div class="placeholder-wave">
		<x-placeholders.table-inner />
	</div>
</template>

<template id="show-placeholder">
	<div class="placeholder-wave">
		<div class="row align-items-center mb-4">
			<div class="col">
				<h2><x-placeholders.span>Placeholder #123</x-placeholders.span></h2>
			</div>

			<div class="col-sm-auto">
				<span class="btn placeholder">Edit</span>
				<span class="btn placeholder">Delete</span>
			</div>
		</div>

		<dl>
			<dt class="mb-1"><x-placeholders.span>Name</x-placeholders.span></dt>
			<dd class="mb-2"><x-placeholders.span>Acme Corporation</x-placeholders.span></dd>

			<dt class="mb-1"><x-placeholders.span>Address</x-placeholders.span></dt>
			<dd class="mb-2">
				<x-placeholders.span>
					Footaster Street 123
					<br>
					12345 Fooville
				</x-placeholders.span>
			</dd>

			<dt class="mb-1"><x-placeholders.span>Budget</x-placeholders.span></dt>
			<dd class="mb-2"><x-placeholders.span>€ 1234</x-placeholders.span></dd>
		</dl>
	</div>
</template>

<template id="form-placeholder">
	<div class="placeholder-wave">
		<h2 class="mb-4"><x-placeholders.span>Placeholder #123</x-placeholders.span></h2>

		<form>
			<div class="form-group">
				<label class="mb-1"><x-placeholders.span>Name field</x-placeholders.span></label>
				<input type="text" class="form-control placeholder">
			</div>

			<div class="form-group">
				<label class="mb-1"><x-placeholders.span>Budget field </x-placeholders.span></label>
				<input type="text" class="form-control placeholder">
			</div>

			<div class="form-group">
				<label class="mb-1"><x-placeholders.span>Address</x-placeholders.span></label>
				<input type="text" class="form-control placeholder">
			</div>
		</form>

		<div class="d-flex align-items-center mt-4">
			<div class="flex-grow-1">
				<span class="btn placeholder">Save</span>
			</div>

			<div>
				<span class="btn placeholder">Cancel</span>
			</div>
		</div>
	</div>
</template>
