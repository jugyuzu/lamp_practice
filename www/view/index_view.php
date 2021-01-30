<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>商品一覧</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'index.css'); ?>">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
    .item_none{
      display: none;
    }
  </style>
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  

  <div class="container">
    <h1>商品一覧</h1>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    <select name="price" id="line_up">
      <option value="new">新着順</option>
      <option value="pricedown">価格が安い順</option>
      <option value="priceup">価格が高い順</option>
    </select>
    <div class="card-deck">
      <div class="row">
      <?php foreach($items as $item){ ?>
        <div class="col-6 item">
          <div class="card h-100 text-center">
            <div class="card-header">
              <?php print($item['name']); ?>
            </div>
            <figure class="card-body">
              <img class="card-img" src="<?php print(IMAGE_PATH . $item['image']); ?>">
              <figcaption>
                <p class="item_price"><?php print(number_format($item['price'])); ?>円</p>
                <?php if($item['stock'] > 0){ ?>
                  <form action="index_add_cart.php" method="post" class="cart_form">
                    <input type="submit" value="カートに追加" class="btn btn-primary btn-block">
                    <input type="hidden" name="token" value=<?php print $token; ?>>
                    <input type="hidden" name="item_id" value="<?php print($item['item_id']); ?>" class="cart_item_id">
                  </form>
                <?php } else { ?>
                  <p class="text-danger">現在売り切れです。</p>
                <?php } ?>
              </figcaption>
            </figure>
          </div>
        </div>
        <?php } ?>
      </div>
      <input type="hidden" name="count" value=1 id="count">
      <input type="hidden" name="item_num" value=4 id="item_num">
      <input type="hidden" name="all_item" value=<?php print $items_count; ?> id="all_item">
    </div>
  </div>
  <script src="./commn_js.js"></script>
  </script>
</body>
</html>