<div class="jumbotron text-center" id="threads-header" style="background:#ff9999;">
    <h2>All Threads made</h2>
    <p>See what everyone is saying and resond to them if you are a member.</p>
    @if (!auth()->check())
        <small class="text-white">Not a member? No problem...</small><br>
        <a type="button" class="btn btn-danger mt-3 text-light" href="{{ '/register' }}">Signup</a>
    @endif

</div>
