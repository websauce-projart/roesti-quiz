@extends('backoffice/template_backoffice')

@section('contenu')
<table class="table">
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
                    <td class="text-primary">{!! $user->pseudo !!}<strong>[Admin]</strong></td>
                    @else
                    <td class="text-primary"><strong>{!! $user->pseudo !!}</strong></td>
                    @endif
                    <td>{!! $user->email !!}</td>
                    <td><a href="{{route('user.edit', [$user->id])}}" class="btn btn-warning btn-block">Modifier</a></td>
                    <td>
                        <form method="POST" action="{{route('user.destroy', [$user->id])}}" >
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Supprimer" class="btn btn-danger btn-block" onclick="return confirm('Vraiment supprimer cet utilisateur ?')">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
@endsection