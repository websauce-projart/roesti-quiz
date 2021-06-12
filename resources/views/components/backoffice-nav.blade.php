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


	<a href="{{ route('admins.index') }}"
	@if ($route == 'admins.index' || $route == 'admins.create')
	class="active"
	@endif
	>Administrateurs</a>


	<a href="{{ route('questions.index') }}"
	@if ($route == 'questions.index' || $route == 'questions.create')
	class="active"
	@endif
	>Questions</a>

	@if(Auth::check())
		<a href="{{ route('logout')}}">Logout</a>
	@else
		<a href="{{ route('login')}}">Login</a>
	@endif

 </div>
