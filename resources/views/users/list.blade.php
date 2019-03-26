<html>
<head>
    <title>会員登録サイト</title>
    <style>
    body { font-size:16pt; color:#555; }
    h1 { font-size:100pt; text-align:right; color:#f6f6f6;
        margin:-50px 0px -100px 0px; }
    th {background-color:#999; color:fff; padding:5px 10px; }
    td {border: solid 1px #aaa; color:#999; padding:5px 10px; }
    </style>
</head>
<body>
    <h1>UsersList</h1>
    <p>登録者リスト</p>
    <!--<form method="POST" action="/hello">
        {{ csrf_field() }}
        <input type="text" name="msg">
        <input type="submit">
    </form>-->

    <table>
    <tr>
        <th>No</th>
        <th>氏名</th>
        <th>メールアドレス</th>
        <th>パスワード</th>
        <th>生年月日</th>
        <th>年齢</th>
        <th>サイトを知った理由</th>
        <th>コメント</th>
        <th>メルマガ希望</th>
    </tr>

    @foreach ($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->password}}</td>
            <td>{{$user->birthday}}</td>
            <td>{{$user->age}}</td>
            <td>{{$user->reason}}</td>
            <td>{{$user->comment}}</td>
            <td>{{$user->notice}}</td>
        </tr>
    @endforeach
    </table>
    <input type="button" onclick="location.href='list/input'" value="新規登録">
    <input type="button" onclick="location.href='list/export'" value="CSVダウンロード">   

<?php

?>




</body>
</html>