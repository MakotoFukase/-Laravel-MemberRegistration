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
    <h1>CustomerList</h1>
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

    @foreach ($customers as $customer)
        <tr>
            <td>{{$customer->id}}</td>
            <td>{{$customer->name}}</td>
            <td>{{$customer->email}}</td>
            <td>{{$customer->password}}</td>
            <td>{{$customer->birthday}}</td>
            <td>{{$customer->age}}</td>
            <td>{{$customer->reason}}</td>
            <td>{{$customer->comment}}</td>
            <td>{{$customer->notice}}</td>
        </tr>
    @endforeach
    </table>
    <input type="button" onclick="location.href='list/input'" value="新規登録">
    <input type="button" onclick="location.href='list/export'" value="CSVダウンロード">



<!-- ↓いろいろ試した結果 -->
<?php
    $customers = array(
            array("名前", "年齢", "血液型"),
            array("太郎", "21", "O"),
            array("ジョン", "23", "A"),
            array("ニキータ", "32", "AB"),
            array("次郎", "22", "B")
        );


 
        foreach ($customers as $customer) {
            print_r($customer);
            echo "<br>";
        }

        $stream = fopen('test.php', 'w');
        if (is_writable('test.php')) {
            echo 'このファイルは書き込み可能です';
        } else {
            echo 'このファイルは書き込みできません';
        }

        ?>
<!-- ↑いろいろ試した結果 -->        
</body>
</html>