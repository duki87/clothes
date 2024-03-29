<h3 class="text-center">Shopping Cart</h3>
<div class="">
  <?php if(empty($cart_id)): ?>
    <p>Your shopping cart is empty.</p>
  <?php else :
    $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
    $results = mysqli_fetch_assoc($cartQ);
    $items = json_decode($results['items'],true);
    $sub_total = 0;

  ?>
    <table class="table table-condensed" id="cart_widget">
      <tbody>
        <?php foreach($items as $item):
          $productQ = $db->query("SELECT * FROM products WHERE id = '{$item['id']}'");
          $product = mysqli_fetch_assoc($productQ);
        ?>
          <tr>
            <td><?=$item['quantity'];?></td>
            <td><?=substr($product['title'], 0,15);?></td> <!--substr function used to decrease number of characters to 15 -->
            <td><?=money($item['quantity'] * $product['price']); ?></td>
          </tr>
        <?php
          $sub_total += ($item['quantity'] * $product['price']);
        endforeach; ?>
        <tr>
          <td></td>
          <td><b>Sub Total</b></td>
          <td><b><?=money($sub_total); ?></b></td>
        </tr>
      </tbody>
    </table>
    <a href="cart.php" class="btn btn-xs btn-primary pull-right">View Cart</a>
    <div class="clearfix">

    </div>
  <?php endif; ?>
</div>
