<div class="main">
    <div class="title">
        <h1>認証トークンを記入後、送信ボタンをクリックしてください</h1>
    </div>
    <div class="input">
        <form action="{{ route('info.get') }}" method="post">
            @csrf
            <input type="text" class="token" name="token">
            <br>
            <input type="submit" value="送信">
        </form>
    </div>
</div>