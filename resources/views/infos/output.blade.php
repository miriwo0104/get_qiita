<div class="main">
    <div class="title">
        <h1>output</h1>
    </div>
    <div class="input">
        @foreach ($decode_res as $res)
            <p>{{ $res->title }}</p>
            <p>{{ $res->updated_at }}</p>
            <br>
            <hr>
        @endforeach
    </div>
</div>