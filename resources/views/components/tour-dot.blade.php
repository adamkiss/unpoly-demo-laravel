@php
	use Illuminate\View\ComponentAttributeBag;

	$html = trim($slot->toHtml());

	if (!str_starts_with($html, '<')) {
		$html = "<p>{$html}</p>";
	}

	// Add a button to close the hint popup.
	$html .= <<<'HTML'
	<p>
		<a href="#" up-dismiss class="btn btn-success btn-sm">OK</a>
	</p>
	HTML;

	$size = match(true) {
		$attributes->has('size') => $attributes->get('size'),
		strlen(strip_tags($html)) > 400 => 'large',
		default => 'medium',
	};

	$attrs = [
		'class' => 'tour-dot',
		'up-layer' => 'new popup',
		'up-content' => e($html),
		'up-position' => $attributes->get('position', 'right'),
		'up-align' => $attributes->get('align', 'top'),
		'up-class' => 'tour-hint',
		'up-size' => $size,
	];

	if ($attributes->has('overlay-only')) {
		$attrs['overlay-only'] = '';
	}

	$attrs = new ComponentAttributeBag($attrs);
@endphp

<a {{ $attrs }}></a>
