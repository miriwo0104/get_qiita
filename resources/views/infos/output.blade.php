<div class="main">
    <div class="title">
        <h1>output</h1>
    </div>
    <div class="input">
        @foreach ($decode_res as $items)
            @foreach ($items as $res)
                @php
                    $created_at = $res->created_at;
                    $timestamp = strtotime($created_at);
                    $datetime = date('Y-m-d H:i:s', $timestamp);
                @endphp
                <hr>
                <br>
                dateTime: {{ $datetime }}
                <br>
                title: {{ $res->title }}
                <br>
                url: {{ $res->url }}
            @endforeach
        @endforeach
    </div>
</div>