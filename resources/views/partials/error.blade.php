@if (count($errors))
    <div class="card mt-3">
        <div class="card-header bg-danger text-white text-center">
            Error
        </div>
        <div class="card-body">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div
@endif
