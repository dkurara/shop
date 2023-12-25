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

if(isset($_SESSION['cart'])==true)
{

$cart=$_SESSION['cart'];
$kazu=$_SESSION['kazu'];
$max=count($cart);
}
else
{
    $max=0;
}

if($max==0)
{
    print 'カートに商品が入っていません。 <br />';
    print '<br />';
    print '<a href="shop_list.php">商品一覧へ戻る</a>';
    exit();
}

$dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password = '12345';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

foreach($cart as $key => $val)
{
    $sql = 'SELECT code,name,price FROM mst_product WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[0]=$val;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    $pro_name[]=$rec['name'];
    $pro_price[]=$rec['price'];
}
$dbh = null;


}
catch (Exception $e)
{
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>

カートの中身 <br />
<br />
<form method="post" action="kazu_change.php">
<?php for($i=0;$i<$max;$i++)
{
?>
    <?=$pro_name[$i]; ?>
    <?=$pro_price[$i].'円'; ?>
    <input type="text" name="kazu<?=$i; ?>" value="<?=$kazu[$i]; ?>">
    <?=$pro_price[$i]*$kazu[$i]; ?>円
    <input type="checkbox" name="sakujo<?=$i; ?>">
    <br />
<?php
}
?>
<form>
<input type="hidden" name="max" value="<?=$max; ?>">
<input type="submit" value="数量変更"><br />
 <input type="button" onclick="history.back()" value="戻る">
</form>

</body>
</html>