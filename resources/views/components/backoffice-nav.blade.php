<div class="topnav topnav--center">

	@php	
	$route = Route::currentRouteName();
	@endphp

	<a href="{{ route('backoffice') }}" 
	@if ($route == 'backoffice')
	class="active"
	@endif
	>Home</a>

	<a href="{{ route('users.index') }}"
	@if ($route == 'users.index')
	class="active"
	@endif
	>Utilisateurs</a>


	<a href="{{ route('indexAdmin') }}"
	@if ($route == 'indexAdmin' || $route == 'addAdmin')
	class="active"
	@endif
	>Administrateurs</a>


	<a href="{{ route('indexQuestion') }}"
	@if ($route == 'indexQuestion' || $route == 'addQuestion')
	class="active"
	@endif
	>Questions</a>

	@if(Auth::check())
		<a href="{{ route('logout')}}">Logout</a>
	@else
		<a href="{{ route('login')}}">Login</a>
	@endif

 </div>
