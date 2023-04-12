<?php
include_once '../header.php';
?>

<?php
require_once '../includeFiles/db.inc.php';
$sql = "SELECT * FROM listing WHERE 'Listing ID' = ".$_GET['product']."";
$statement = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($statement, $sql)) {
    header("location: ../ClothingCategories/Accessories.php?error=statementfailed");
    exit();
}
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
$item = mysqli_fetch_array($result);
mysqli_stmt_close($statement);


$sql = "SELECT * FROM clothing WHERE 'Listing ID' = ".$_GET['product']."";
$statement = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($statement, $sql)) {
    header("location: ../ClothingCategories/Accessories.php?error=statementfailed");
    exit();
}
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
$clothing = mysqli_fetch_array($result);
mysqli_stmt_close($statement);

$cid = $clothing['Clothing ID'];
$sql = "SELECT * FROM style WHERE 'Clothing ID' = $cid";
$statement = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($statement, $sql)) {
    header("location: ../ClothingCategories/Accessories.php?error=statementfailed");
    exit();
}
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
$tags = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($statement);

if($item['Visibility']  == 1){
?>
<div class="text-container">
  <h1><?php echo $item['Title']?></h1>
  <h2>Price: $<?php echo $item['Price']?></h2>
  <p>Tags:
  <?php
  if ($tags !== false && count($tags) > 0) {
      foreach ($tags as $s) {?>
          <?php echo $s['StyleName'] ?>
      <?php
      }
  }
  ?>
  </p>
  <p>Color: <?php echo $clothing['Colour']?></p>
  <p>Condition: <?php echo $clothing['Clothing Condition']?></p>
  <p>Brand: <?php echo $clothing['Brand']?></p>
  <p>Gender: <?php echo $clothing['Gender']?></p>
  <p>Measurements:   </p>
  <?php
  if ($item['Clothing Category'] == "Accessory") {
    $sql = "SELECT * FROM accessories WHERE 'Clothing ID' = $cid";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../ClothingCategories/Accessories.php?error=statementfailed");
        exit();
    }
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $measurements = mysqli_fetch_array($result);
    mysqli_stmt_close($statement);
    ?>
<p> Accessory of type: <?php echo $measurements['Type']?> </p>
<?php
  }else if ($item['Clothing Category'] == "Bottoms"){
    $sql = "SELECT * FROM bottoms WHERE 'Clothing ID' = $cid";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../ClothingCategories/Accessories.php?error=statementfailed");
        exit();
    }
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $measurements = mysqli_fetch_array($result);
    mysqli_stmt_close($statement);
    ?>
<p> Waist Size: <?php echo $measurements['Waist']?> </p>
<p> Hip Size: <?php echo $measurements['Hip']?> </p>
<p> Inseam Size: <?php echo $measurements['Inseam']?> </p>

<?php
  }
  else if ($item['Clothing Category'] == "Shoes"){
    $sql = "SELECT * FROM shoes WHERE 'Clothing ID' = $cid";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../ClothingCategories/Accessories.php?error=statementfailed");
        exit();
    }
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $measurements = mysqli_fetch_array($result);
    mysqli_stmt_close($statement);
    ?>
<p> Shoe size: <?php echo $measurements['Shoe Size']?> </p>

<?php
  }
  else if ($item['Clothing Category'] == "Tops"){
    $sql = "SELECT * FROM tops WHERE 'Clothing ID' = $cid";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../ClothingCategories/Accessories.php?error=statementfailed");
        exit();
    }
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $measurements = mysqli_fetch_array($result);
    mysqli_stmt_close($statement);
    ?>
<p> Chest Size: <?php echo $measurements['Chest']?> </p>
<p> Waist Size: <?php echo $measurements['Waist']?> </p>
<p> Hip Size: <?php echo $measurements['Hip']?> </p>

<?php
  }
  ?>
  <p>Date Listed: <?php echo $item['Date']?></p>
  <p>Listed By: <?php echo $item['SellerUser']?></p>
  <?php 
  if(isset($_SESSION["sessUsername"])) {
    if ($item['SellerUser'] != $_SESSION["sessUsername"])
    {?>
    <form action="../includeFiles/messaging.inc.php" method="post">
      <input type="hidden" name="clientID" value="<?php echo $item['SellerUser']?>">
      <button type="submit" name="submit">Message the Seller</button>
    </form>
    <?php 
    } 
  }
  else{
    ?>
    <form action="../includeFiles/messaging.inc.php" method="post">
      <input type="hidden" name="clientID" value="<?php echo $item['SellerUser']?>">
      <button type="submit" name="submit">Message the Seller</button>
    </form>
    <?php 
  } ?>
</div>
<div class="image-container">
  <?php
  $gallery = $item['Gallery ID'];
  $sql = "SELECT PhotoURL FROM photo WHERE GalleryID = $gallery";
  $statement = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($statement, $sql)) {
      header("location: ../ClothingCategories/Accessories.php?error=statementfailed");
      exit();
  }
  mysqli_stmt_execute($statement);
  $result = mysqli_stmt_get_result($statement);
  $images = mysqli_fetch_all($result, MYSQLI_ASSOC);
  mysqli_stmt_close($statement);

  if ($images !== false && count($images) > 0) {
      foreach ($images as $i) {?>
          <img class="image" src="<?php echo $i['PhotoURL'] ?>" />
      <?php
      }
  }
  ?>
</div>
<?php
} else{
?>
  <h1>This item is not currently approved, check back later!</h1>
<?php
}
?>
<?php
include_once '../footer.php';
?>

<style>
  .text-container {
    width: calc(100% / 3);
    float: left;
    padding: 20px;
  }
  .image-container {
    margin-top: 20px;
    width: 1200px;
    float: right;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }
  .image {
    margin-right: 20px; 
    margin-left: 20px; 
    float: right;
    max-width: 40%;
    height: auto;
  }
</style>