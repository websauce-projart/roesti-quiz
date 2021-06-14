@extends('template')

@section('title')
Administrateurs
@endsection

@push('body-classes')
pattern-stop
@endpush

@section('content')

<x-backoffice-nav></x-backoffice-nav>

<div class="container container--large">
	<div class="center">
		<strong>Liste des administrateurs</strong> | <a href="{{route('admins.create')}}">Créer un administrateur</a>
	</div>

    @if(session()->has('ok'))
    <div>
        {!! session('ok') !!}
    </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Pseudo</th>
                <th>E-Mail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{!! $user->id !!}</td>
                <td><strong>{!! $user->pseudo !!}</strong></td>
                <td><a href="mailto:{!! $user->email !!}">{!! $user->email !!}</a></td>
                <td><a class="icon-edit-pencil" href="{{route('admins.edit', [$user->id])}}"></a></td>
                <td>
                    <form method="POST" action="{{route('admins.destroy', [$user->id])}}">
                        @csrf
                        @method('DELETE')
                        <button class="icon-close" type="submit"
                            onclick="return confirm('Vraiment supprimer cet administrateur ?')"></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
