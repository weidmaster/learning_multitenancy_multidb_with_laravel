@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div><br>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div><br>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div><br>
@endif
