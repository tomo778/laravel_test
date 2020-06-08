<!DOCTYPE html>
<html lang="ja">
<style>
    body {
        background-color: #fff;
        margin: 50px;
    }

    h1 {
        font-size: 16px;
        color: #ff6666;
    }

    #button {
        width: 200px;
        text-align: center;
    }

    #button a {
        padding: 10px 20px;
        display: block;
        border: 1px solid #2a88bd;
        background-color: #FFFFFF;
        color: #2a88bd;
        text-decoration: none;
        box-shadow: 2px 2px 3px #f5deb3;
    }

    #button a:hover {
        background-color: #2a88bd;
        color: #FFFFFF;
    }
</style>
<body>
    <h1>htmlメールテスト</h1>
    <p>{{$name}}</p>
    <p>{{$address}}</p>
    <p>購入商品</p>
    <table>
        @foreach ($data as $k => $v)
        <td>{{$v['title']}}</td>
        <td>{{$v['price']}}</td>
        @endforeach
    </table>
    </br>
    <p>ありがとうございました</p>
</body>
</html>