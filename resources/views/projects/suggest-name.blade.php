<x-layout>
	@foreach ($names as $name)
		@if($loop->first)
		<x-tour-dot>
			<p>
				Each suggestion button has an <code>[up-emit="name:select"]</code> attribute.
				When clicked it emits an <code>name:select</code> event on
				the popup element.
			</p>
			<p>
				The link that opened this popup is awaiting this event
				via its <code>[up-accept-event]</code> attribute. When the element
				is observed, the popup is automatically closed and the name copied
				into the project form.
			</p>
		</x-tour-dot>
		@endif

		<a up-emit="name:select"
			up-emit-props='{{ json_encode(['name' => $name]) }}'
			class="btn btn-info text-light mb-2 me-1"
			tabindex="0">
			{{ $name }}
		</a>
	@endforeach
</x-layout>
