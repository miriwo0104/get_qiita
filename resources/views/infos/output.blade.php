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
                <h5>日時</h5>
                <p>{{ $datetime }}</p>
                <h5>記事タイトル</h5>
                <p>{{ $res->title }}</p>
                <h5>リンク</h5>
                <a href="{{ $res->url }}">{{ $res->url }}</a>
            @endforeach
        @endforeach
    </div>
</div>