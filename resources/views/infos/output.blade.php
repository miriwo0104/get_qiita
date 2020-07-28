<div class="main">
    <div class="title">
        <h1>output</h1>
    </div>
    <div class="input">
        <div>
            | 記事投稿日 | 記事タイトル | 記事リンク |
        </div>
        <div>
            | --- | --- | --- |
        </div>
        @foreach ($decode_res as $items)
            @foreach ($items as $res)
                @php
                    $created_at = $res->created_at;
                    $timestamp = strtotime($created_at);
                    $datetime = date('Y-m-d H:i:s', $timestamp);
                @endphp

                <div>
                    | {{ $datetime }} | {{ $res->title }} | [{{ $res->url }}]({{ $res->url }}) |
                </div>
            @endforeach
        @endforeach
    </div>
</div>