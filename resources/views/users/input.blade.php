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
            <form method="post" action="input">
                {{ csrf_field() }}
                <tr><th align="left">氏名 </th><td><input type="text" name="name">
                    </td></tr>
                <tr><th align="left">メールアドレス </th><td><input type="text" name="email">
                    </td></tr>
                <tr><th align="left">パスワード </th><td><input type="text" name="password">
                    </td></tr>
                <tr><th align="left">生年月日 </th><td><input type="date" name="birthday">
                    </td></tr>
                <tr><th align="left">年齢 </th><td><input type="integer" name="age">
                    </td></tr>
                <tr><th align="left">サイトを知った理由 </th><td>
                    <input type="radio" name="reason_id" value=0>チラシを見た<br>
                    <input type="radio" name="reason_id" value=1>電車広告を見た<br>
                    <input type="radio" name="reason_id" value=2>SNSで見た<br>
                    <input type="radio" name="reason_id" value=3>お友達に聞いた<br>
                    </td></tr>
                <tr><th align="left">コメント </th><td><input type="text" name="comment">
                    </td></tr>
                <tr><th align="left">メルマガ希望 </th><td>
                    <input type="radio" name="notice_id" value=0>希望する<br>
                    <input type="radio" name="notice_id" value=1>希望しない<br>
                    </td></tr>        
            </form>
        </table>
        <button type="button" onclick="history.back()">戻る</button>
        <input type="submit" value="登録">
</body>
</html>