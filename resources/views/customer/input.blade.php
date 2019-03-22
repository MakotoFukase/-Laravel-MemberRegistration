<html>
<head>
    <title>会員登録サイト</title>
    <style>
    body { font-size:16pt; color:#999; }
    h1 { font-size:100pt; text-align:right; color:#f6f6f6;
        margin:-50px 0px -100px 0px; }
    th {background-color:#999; color:fff; padding:5px 10px; }
    td {border: solid 1px #aaa; color:#999; padding:5px 10px; }
        </style>
</head>
<body>
        <h1>Input</h1>
        <p>登録画面</p>
    
        <table>
        <form method="post" action="/list/input">
            {{ csrf_field() }}
            <tr><th>氏名: </th><td><input type="text" name="name">
                </td></tr>
            <tr><th>メールアドレス: </th><td><input type="text" name="email">
                </td></tr>
            <tr><th>パスワード: </th><td><input type="text" name="password">
                </td></tr>
            <tr><th>生年月日: </th><td><input type="date" name="birthday">
                </td></tr>
            <tr><th>年齢: </th><td><input type="integer" name="age">
                </td></tr>
            <tr><th>サイトを知った理由: </th><td><input type="integer" name="reason">
                </td></tr>
            <tr><th>コメント: </th><td><input type="text" name="comment">
                </td></tr>
            <tr><th>メルマガ希望: </th><td><input type="integer" name="notice">
                </td></tr>
            <tr><th></th><td><input type="submit" value="登録">
        </form>
        </table>
</body>
</html>