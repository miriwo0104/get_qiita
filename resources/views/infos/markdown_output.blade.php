<div class="main">
    <div class="title">
        <h1>markdown output</h1>
    </div>
    <div class="input">
        | 記事投稿日 | 記事タイトル | 記事リンク |
        <br>
        | --- | --- | --- |
        @foreach ($decode_res as $items)
            @foreach ($items as $res)
                @php
                    $created_at = $res->created_at;
                    $timestamp = strtotime($created_at);
                    $datetime = date('Y-m-d H:i:s', $timestamp);
                @endphp
                <br>
                | {{ $datetime }} | {{ $res->title }} | [{{ $res->url }}]({{ $res->url }}) |
            @endforeach
        @endforeach
    </div>
</div>