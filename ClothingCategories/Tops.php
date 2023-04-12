<?php
include_once '../header.php';
?>

<?php
require_once '../includeFiles/db.inc.php';
$result = $conn->query("SELECT image FROM photos ORDER BY GalleryID DESC");

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
?>
<div class="gallery">
    <?php if($result->num_rows > 0){ ?>
        <?php while($row = $result->fetch_assoc()){ ?>
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" />
        <?php } ?>
    <?php }else{ ?>
        <p class="status error">Image(s) not found...</p>
    <?php }
    ?>
</div>
<div class="item">
  <h1> <a href="item.php?product=<?php echo $id ?>" style="text-decoration:none; color:inherit;"><?php echo $title ?></a> </h1>
  <?php
    $img_sql = "SELECT image FROM photos WHERE GalleryID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $img_sql)) {
      header("location: ../ClothingCategories/Accessories.php?error=statementfailed");
      exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $gallery);
    mysqli_stmt_execute($stmt);
    $img_result = mysqli_stmt_get_result($stmt);
    if (!$img_result) {
        printf("Error: %s\\n", mysqli_error($conn));
        exit();
    }
    $img_row = mysqli_fetch_assoc($img_result);
    $image = $img_row['image'];
    mysqli_stmt_close($stmt);
  ?>
  <a href="item.php?product=<?php echo $id ?>"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>" class="img_dis" width="200" height="200"> </a>
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
    left: 25%;
  }
</style>