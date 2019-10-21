<?php
      require_once 'core/init.php';
      include 'includes/head.php';
      include 'includes/nav.php';
      include 'includes/headerfull.php';
      include 'includes/leftbar.php';

      $sql = "SELECT * FROM products WHERE featured = 1";
      $featured = $db->query($sql);

?>
    <!--The main content-->
    <div class="col-md-8">
      <div class="row">
        <h2 class="text-center">Предмети на акцији</h2>
        <?php while($product = mysqli_fetch_assoc($featured)) : ?>
          <div class="col-sm-3 text-center">
            <h4><?php echo $product['title']; ?></h4>
            <?php $photos = explode(',',$product['image']); ?>
            <img src="<?=$photos[0]; ?>" alt="<?php echo $product['title']; ?>"  class="img-thumb">
            <p class="list-price text-danger">Последња цена: <s>$ <?php echo $product['list_price']; ?></s></p>
            <p class="price">Цена за вас: $ <?php echo $product['price']; ?></p>
            <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?php echo $product['id']; ?>)">Детаљи</button>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  <?php
    include 'includes/rightbar.php';
    include 'includes/footer.php';
  ?>
