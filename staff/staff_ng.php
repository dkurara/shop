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
    <title>スタッフ未選択</title>
</head>
<body>
    
スタッフが選択されていません。 <br />
<a href="staff_list.php">戻る</a>

</body>
</html>