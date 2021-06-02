stp confirme ton mail

@if (session('resent'))
    {{ Session::get('success') }}
@endif

<form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
    @csrf
    <button type="submit"
        class="btn btn-link p-0 m-0 align-baseline">si ta perdu ton mail clic ici lol</button>
</form>