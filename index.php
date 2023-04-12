<?php
include_once 'header.php';
?>


<div class="homeImage"> <img src = https://media.gq.com/photos/611be81a539f373b4ca1c04c/16:9/w_2560%2Cc_limit/GQ0921_Drops_706675;68_View.png width="1000" height="600"> <div class="image-container"> </div>
<div><h1 class = top> Welcome to ClotheSwap! </h1>
<h2 class = desc> Click on the menu above to browse by category, <br> or create an account to sell and buy clothing! </h2></div>


<?php
include_once 'footer.php';
?>

<style>
  .top {
    margin-right: 20px; 
    margin-left: -80px; 
    color: black;
    float: left;
  }
  .desc {
    margin-right: 20px; 
    margin-left: 20px; 
    color: black;
    float: left;
  }
  .homeImage {
    margin-right: 20px; 
    top: 10%;
    left: 25%;
    position: fixed;
    max-width: 75%;
    display: block;
    z-index:-1;
  }
</style>