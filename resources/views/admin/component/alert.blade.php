@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="margin-bottom: 10px;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 
@if(Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
@endif
 
@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
@endif
