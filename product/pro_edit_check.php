<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
    print 'ログインされていません。 <br />';
    print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
}
else
{
    print "{$_SESSION['staff_name']}さんログイン中<br />";
    print '<br />';
}
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修正してください</title>
</head>
<body>

<?php

require_once('../common/common.php');

$post=sanitize($_POST);
$pro_code=$post['code'];
$pro_name=$post['name'];
$pro_price=$post['price'];

if($pro_name=='')
{
    print '商品名が入力されていません。<br />';
}
else
{
    print "商品名：{$pro_name} <br />";
}

if(preg_match('/\A[0-9]+\z/', $pro_price)==0)
{
    print '価格をきちんと入力してください。 <br />';
}
else
{
    print "価格：{$pro_price} 円<br />";
}

if($pro_name==''||preg_match('/\A[0-9]+\z/',$pro_price)==0)
{
    print '<form>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '</form>';
}
else
{
    print '上記のように変更します。 <br />';
    print '<form method="post" action="pro_edit_done.php">';
    print '<input type="hidden" name="code" value="'.$pro_code.'">';
    print '<input type="hidden" name="name" value="'.$pro_name.'">';
    print '<input type="hidden" name="price" value="'.$pro_price.'">';
    print '<br />';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '<input type="submit" value="OK">';
    print '<form/>';
}

?>

</body>
</html>