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
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品情報変更</title>
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

$sql = 'SELECT name,price FROM mst_product WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[] = $pro_code;
$stmt->execute($data);

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$pro_name=$rec['name'];
$pro_price=$rec['price'];

$dbh = null;

}
catch (Exception $e)
{
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>

商品修正 <br />
<br />
商品コード <br />
<?= $pro_code; ?>
<br />
<br />
<form method="post" action="pro_edit_check.php">
<input type="hidden" name="code" value="<?=$pro_code; ?>">
商品名 <br />
<input type="text" name="name" style="width:200px" value="<?=$pro_name; ?>"><br />
価格 <br />
<input type="text" name="price" style="width:50px" value="<?=$pro_price; ?>">円<br />
 <br />
 <input type="button" onclick="history.back()" value="戻る">
 <input type="submit" value="OK">
</form>

</body>
</html>