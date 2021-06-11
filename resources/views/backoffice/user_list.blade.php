@extends('template')

@section('title')
Backoffice: Utilisateurs
@endsection

@section('content')

<x-backoffice-nav></x-backoffice-nav>
<div class="container container--large">
	<table>
		<thead>
				<tr>
					<th>#</th>
					<th>Pseudo</th>
					<th>E-Mail</th>
					<th></th>
					<th></th>
				</tr>
		</thead>
		<tbody>
				@foreach ($users as $user)
				<tr>
					<td>{!! $user->id !!}</td>
					@if($user->admin == 1)
					<td>{!! $user->pseudo !!} <strong>[Admin]</strong></td>
					@else
					<td><strong>{!! $user->pseudo !!}</strong></td>
					@endif
					<td><a href="mailto:{!! $user->email !!}">{!! $user->email !!}</a></td>
					<td><a class="icon-edit-pencil" href="{{route('user.edit', [$user->id])}}"></a></td>
					<td>
						<form method="POST" action="{{route('user.destroy', [$user->id])}}" >
								@csrf
								@method('DELETE')
								<button class="icon-close" type="submit" onclick="return confirm('Vraiment supprimer cet utilisateur ?')"></button>
						</form>
					</td>
				</tr>
				@endforeach
		</tbody>
	</table>
</div>

@endsection
