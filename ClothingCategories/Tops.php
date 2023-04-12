<?php
include_once '../header.php';
?>

<?php
require_once '../includeFiles/db.inc.php';
$sql = "SELECT ListingID, Price, Title, GalleryID FROM listing WHERE ClothingCategory = 'tops'";
$statement = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($statement, $sql)) {
  header("location: ../ClothingCategories/Accessories.php?error=statementfailed");
  exit();
}
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($statement);

if ($rows !== false && count($rows) > 0) {
  foreach ($rows as $l) {
    $id = $l['ListingID'];
    $price = $l['Price'];
    $title = $l['Title'];
    $gallery = $l['GalleryID'];
    $sql = "SELECT Image FROM photos WHERE GalleryID = $gallery";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
      header("location: ../ClothingCategories/Accessories.php?error=statementfailed");
      exit();
    }
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $image = mysqli_fetch_assoc($result)['Image'];
    mysqli_stmt_close($statement);
?>
    <div class="item">
      <h1 class="item"> <a href="item.php?product=<?php echo $id ?>" style="text-decoration:none; color:inherit;"><?php echo $title ?></a> </h1>

      <a href="item.php?product=<?php echo $id ?>"><img src=<?php echo $image ?> class="img_dis" width="200" height="200"> </a>

      <h2 class="price">$ <?php echo $price; ?></h2>
    </div>
  <?php
  }
} else { ?>
  <section class="None Found">
    <h1> Sorry, no tops were found! </h1>
  </section>
<?php
}  ?>

<?php
include_once '../footer.php';
?>

<style>
  .item {
    display: flex;
    flex-direction: column;
    margin-right: 20px;
    margin-left: 20px;
    vertical-align: top;
    color: black;
  }

  .price {
    display: flex;
    flex-direction: column;
    margin-right: 20px;
    margin-left: 20px;
    vertical-align: top;
  }
</style>