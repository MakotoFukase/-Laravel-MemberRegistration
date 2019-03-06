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
    <h1>MemberList</h1>
    <p>登録者リスト</p>
    <!--<form method="POST" action="/hello">
        {{ csrf_field() }}
        <input type="text" name="msg">
        <input type="submit">
    </form>-->

    <table>
    <tr><th>No</th><th>氏名</th><th>メールアドレス</th><th>パスワード</th><th>生年月日</th><th>年齢</th><th>サイトを知った理由</th><th>コメント</th><th>メルマガ希望</th></tr>
    @foreach ($members as $member)
        <tr>
            <td>{{$member->id}}</td>
            <td>{{$member->name}}</td>
            <td>{{$member->email}}</td>
            <td>{{$member->password}}</td>
            <td>{{$member->birthday}}</td>
            <td>{{$member->age}}</td>
            <td>{{$member->reason}}</td>
            <td>{{$member->comment}}</td>
            <td>{{$member->notice}}</td>
        </tr>
    @endforeach
    </table>
    <input type="button" onclick="location.href='member_list/register'" value="新規登録">
</body>
</html>