@extends('/home/template_home')

@section('title')
RöstiQuiz - Modifier le mot de passe
@endsection

@section('contenu')
    @if (Session::has('message'))
    {{ Session::get('message') }}
    @endif
     <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('updatePassword') }}" method="post">
           @csrf
            <div class="form-group">
            <x-input-text label="Ancien mot de passe" id="oldpassword" placeholder="Entrez votre ancien mot de passe" type="password"></x-input-text>
            {!! $errors->first('oldpassword', '<small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group">
            <x-input-text label="Nouveau mot de passe" id="newpassword" placeholder="Entrez votre nouveau mot de passe" type="password"></x-input-text>
            {!! $errors->first('newpassword', '<small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group">
            <x-input-text label="Confirmez le nouveau mot de passe" id="password_confirmation" placeholder="Confirmez votre nouveau mot de passe" type="password"></x-input-text>
            {!! $errors->first('password_confirmation', '<small class="help-block">:message</small>') !!}
            </div>
            <button type="submit" class="btn btn-primary">Modifier mon mot de passe!</button>
                     
        </form>    
@endsection