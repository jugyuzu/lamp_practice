<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>注文詳細</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'index.css'); ?>">
  <style type="text/css">
    
    table,th,tr{
        margin-top: 50px;
        width: 600px;
        }
    .row{
        display:block;
    }
</style>
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  

  <div class="container">
    <h1>注文詳細</h1>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <div class="card-deck">
      <div class="row">
        <div>
            <table>
                <tr>
                    <th>注文番号</th>
                    <th>日付</th>
                    <th>合計金額</th>
                </tr>
                <?php foreach($values as $value){ ?>
                    <tr>
                        <td><?php print $value['order_id']; ?></td>
                        <td><?php print $value['created']; ?></td>
                        <td><?php print number_format($item['total']); ?>円</td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div>
            <table>
                <tr>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>購入数</th>
                    <th>小計</th>
                </tr>
                <?php foreach($items as $item){ ?>
                    <tr>
                        <td><?php print $item['name']; ?></td>
                        <td><?php print $item['price']; ?></td>
                        <td><?php print $item['amount']; ?></td>
                        <td><?php print number_format($item['subtotal']); ?>円</td>
                    </tr>
                <?php } ?>
            </table>
        </div>
      </div>
    </div>
  </div>
  
</body>
</html>