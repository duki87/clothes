<?php
  require_once $_SERVER['DOCUMENT_ROOT']. '/clothes/core/init.php';
  if(!is_logged_in()) {
    login_error_redirect();
  }
  include 'includes/head.php';
  include 'includes/nav.php';

?>
<?php
  $archSql = "SELECT * FROM products WHERE deleted = 1";
  $archResults = $db->query($archSql);
  if(isset($_GET['restore'])) {
    $restore_id = (int)$_GET['id'];
    $restore = (int)$_GET['restore'];
    $restoreSql = "UPDATE products SET deleted = '$restore' WHERE id = '$restore_id'";
    $db->query($restoreSql);
    header('Location: archproducts.php');
  }
?>
<h2 class="text-center">Archived Products</h2><hr>
  <table class="table table-bordered table-striped">
    <thead>
      <th>Product</th><th>Category</th><th>Restore</th>
    </thead>
    <tbody>
      <?php while($product = mysqli_fetch_assoc($archResults)) :
        $childID = $product['categories'];
        $catSql = "SELECT * FROM categories WHERE id = '$childID'";
        $result = $db->query($catSql);
        $child = mysqli_fetch_assoc($result);
        $parentID = $child['parent'];
        $pSql = "SELECT * FROM categories WHERE id = '$parentID'";
        $presult = $db->query($pSql);
        $parent = mysqli_fetch_assoc($presult);
        $category = $parent['category'].'~'.$child['category'];
      ?>
      <tr>
        <td><?=$product['title']; ?></td>
        <td><?= $category; ?></td>
        <td><a href="archproducts.php?restore=<?=(($product['deleted'] == 1)?'0':''); ?>&id=<?=$product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-retweet"></span></a>Click to restore to active products.</td>
      </tr>
     <?php endwhile; ?>
    </tbody>

  </table>

  <?php

    include 'includes/footer.php'; ?>
  <script>
      jQuery('document').ready(function() {
        get_child_options('<?=$category; ?>');
      });
  </script>
