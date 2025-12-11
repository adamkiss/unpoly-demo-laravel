<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Unpoly Demo</title>
		<meta name="csrf-param" content="authenticity_token" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />

		<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1'>

        <link rel="preconnect" href="https://fonts.bunny.net">

		@vite(['resources/css/app.css', 'resources/js/app.js'])
	</head>

	<body>
		<nav class="navbar navbar-expand navbar-light bg-light fixed-top">
			<a href="/" class="navbar-brand" up-follow up-placeholder="#index-placeholder">Unpoly Demo</a>
			<div class="navbar-nav">
				<span class="nav-link">
					<x-tour-dot>
						<p>Navigation links have the <code>[up-follow]</code> attribute. Clicking such links only updates a <b>page fragment</b>. The remaining DOM is not changed.</p>
						<p>Unpoly links can update arbitrary fragments, identified by CSS selectors. The default selector is the <code>&lt;main&gt;</code> element.</p>
					</x-tour-dot>
				</span>
				<a href="{{ route('companies.index') }}" class="nav-item nav-link" up-follow up-alias="/companies/*" up-placeholder="#index-placeholder { rows: 5 }">Companies</a>
				<a href="{{ route('projects.index') }}" class="nav-item nav-link" up-follow up-alias="/projects/*" up-placeholder="#index-placeholder">Projects</a>
				<a href="{{ route('tasks.index') }}" class="nav-item nav-link" up-follow up-alias="/tasks/*" up-placeholder="#index-placeholder">Tasks</a>
			</div>
		</nav>

		<div class="text-secondary" id="new-version" hidden up-anchored="right">
			A newer version is available!
			<a href="javascript:location.reload()" class="btn btn-secondary btn-sm ms-2">Reload</a>
		</div>

		<div class="flashes-explainer" up-anchored="right">
			<x-tour-dot position="left">
				<p>
					The element after this one uses the <code>[up-flashes]</code> attribute
					to extract notification messages from any response, even
					if this container wasn't targeted.
				</p>

				<p>
					A <a href="https://unpoly.com/up.compiler">compiler</a> removes any <code>&lt;div class="alert"&gt;</code>
					after some seconds.
				</p>
			</x-tour-dot>
			Notifications go here
		</div>

		<div up-flashes up-anchored="right">
			@foreach (session('flashes') ?? [] as $message => $type)
				<x-flash :type="$type" :message="$message" />
			@endforeach
		</div>

		<div class="container">
			<main>
				{{ $slot }}
			</main>
		</div>

		<x-fragment-explainer/>

		@unless (request()->up()->is())
			<x-placeholders.all />
		@endunless

	</body>
</html>
