@extends('template')

@section('title')
Utilisateurs
@endsection

@push('body-classes')
pattern-stop
@endpush

@section('content')

<x-backoffice-nav></x-backoffice-nav>

<div class="container container--large">

    <div class="center">
        <strong>Liste des utilisateurs</strong>
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
                <th>Score total</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{!! $user->id !!}</td>
                <td><strong>{!! $user->pseudo !!}</strong></td>
                <td><a href="mailto:{!! $user->email !!}">{!! $user->email !!}</a></td>
                <td>{!! $user->getTotalScore() !!}</td>
                <td><a class="icon-edit-pencil" href="{{route('users.edit', [$user->id])}}"></a></td>
                <td>
                    <form method="POST" action="{{route('users.destroy', [$user->id])}}">
                        @csrf
                        @method('DELETE')
                        <button class="icon-close" type="submit"
                            onclick="return confirm('Vraiment supprimer cet utilisateur ?')"></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
