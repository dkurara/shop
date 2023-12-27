<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
    print 'ようこそゲスト様　';
    print '<a href="member_login.html">会員ログイン</a><br />';
    print '<br />';
}
else
{
    print 'ようこそ';
    print $_SESSION['member_name'];
    print '様　';
    print '<a href="member_logout.php">ログアウト</a><br />';
    print '<br />';
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品詳細</title>
</head>
<body>

<?php

try
{

$pro_code=$_GET['procode'];

$dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password = '12345';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT name,price,pic FROM mst_product WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[] = $pro_code;
$stmt->execute($data);

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$pro_name=$rec['name'];
$pro_price=$rec['price'];
$pro_gazou_name=$rec['pic'];

$dbh = null;

}
catch (Exception $e)
{
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

if($pro_gazou_name=='')
{
    $disp_gazou='';
}
else
{
    $disp_gazou='<img src="../product/gazou/'.$pro_gazou_name.'">';
}

print '<a href="shop_cartin.php?procode='.$pro_code.'">カートに入れる</a><br /><br />';

?>

商品情報 <br />
<br />
商品コード <br />
<?= $pro_code; ?>
<br />
商品名 <br />
<?=$pro_name; ?>
<br />
価格 <br />
<?=$pro_price; ?> 円
<br />
<?=$disp_gazou; ?>
<br />
<br />
<form>
 <input type="button" onclick="history.back()" value="戻る">
</form>

</body>
</html>