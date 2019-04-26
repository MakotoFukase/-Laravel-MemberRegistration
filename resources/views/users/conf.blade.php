<html>
<head>
    <link rel="shortcut icon" href="../../../images/favicon.ico"/>
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
    <h1>Conf</h1>
    <p>確認画面</p>

    <table>
        {{ csrf_field() }}
        <tr>
            <th align="left">氏名 </th>
            <td>{{$name}}</td>
        </tr>
        <tr>
            <th align="left">メールアドレス </th>
            <td>{{$email}}</td>
        </tr>
        <tr>
            <th align="left">パスワード </th>
            <td>{{$password}}</td>
        </tr>
        <tr>
            <th align="left">生年月日 </th>
            <td><input type="date" name="birthday" value="{{$birthday}}" disabled="disabled"></td>
        </tr>
        <tr>
            <th align="left">年齢 </th>
            <td>{{$age}}</td>
        </tr>
        <tr>
            <th align="left">サイトを知った理由 </th>
            <td>
                <input type="radio" name="reason_id" disabled="disabled"
                    <?php if($reason_id == 0){echo 'checked="checked"';}?>>チラシを見た<br>
                <input type="radio" name="reason_id" disabled="disabled"
                    <?php if($reason_id == 1){echo 'checked="checked"';}?>>電車広告を見た<br>
                <input type="radio" name="reason_id" disabled="disabled"
                    <?php if($reason_id == 2){echo 'checked="checked"';}?>>SNSで見た<br>
                <input type="radio" name="reason_id" disabled="disabled"
                    <?php if($reason_id == 3){echo 'checked="checked"';}?>>お友達に聞いた<br>
            </td>
        </tr>
        <tr>
            <th align="left">コメント </th>
            <td>{{$comment}}</td>
        </tr>
        <tr>
            <th align="left">メルマガ希望 </th>
            <td>
                <input type="radio" name="notice_id" disabled="disabled"
                    <?php if($notice_id == 0){echo 'checked="checked"';}?>>希望する<br>
                <input type="radio" name="notice_id" disabled="disabled"
                    <?php if($notice_id == 1){echo 'checked="checked"';}?>>希望しない<br>
            </td>
        </tr>               
    </table>
        
    <button type="button" onclick="history.back()">戻る</button>
    <input type="button" onclick="location.href='/input/conf/complete'" value="登録">
   
</body>
</html>