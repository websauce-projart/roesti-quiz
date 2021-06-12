<div class="topnav topnav--center">

	<a href="{{ route('backoffice') }}">Home</a>
	<a href="{{ route('user.index') }}">Utilisateurs</a>
	<a href="{{ route('question.index') }}">Question</a>

	@if(Auth::check())
		<a href="{{ route('logout')}}">Logout</a>
	@else
		<a href="{{ route('login')}}">Login</a>
	@endif

 </div>
