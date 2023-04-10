<?php
include_once '../header.php';
?>
<?php
$query = 'SELECT * FROM listings WHERE id = "'.$_GET['product'].'"';
?>

<?php
include_once '../footer.php';
?>