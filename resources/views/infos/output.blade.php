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

                <p>| 記事投稿日 | 記事タイトル | 記事リンク |</p>
                <p>| --- | --- | --- |</p>
                <p>| {{ $datetime }} | {{ $res->title }} | {{ $res->url }} |</p>
                <br>
            @endforeach
        @endforeach
    </div>
</div>