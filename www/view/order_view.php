<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>履歴一覧</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'index.css'); ?>">
  <style type="text/css">
    th,tr{
        width:120px;}
</style>
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  

  <div class="container">
    <h1>履歴一覧</h1>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <div class="card-deck">
      <div class="row">
        <table>
            <tr>
                <th>注文番号</th>
                <th>日付</th>
                <th>合計金額</th>
            </tr>
            <?php foreach($items as $item){ ?>
                <tr>
                    <td><?php print $item['order_id']; ?></td>
                    <td><?php print $item['created']; ?></td>
                    <td><?php print number_format($item['total']); ?>円</td>
                    <td><a href="./template.php?id=<?php print $item['order_id']; ?>">購入明細表示</a></td>
                </tr>
            <?php } ?>
        </table>
      </div>
    </div>
  </div>
  
</body>
</html>