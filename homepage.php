<html>
    <head>
        <meta charset="UTF-8">
        <title>Homepage</title>
        <link href="homepage.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>   
     <?php include './header1.php'; ?>
       
  <div class="slideshow-container" style="margin-top:30px;margin-bottom:30px;margin-left:250px;">
  
  <div class="mySlides fade">
    <img src='image/gypsophila1a.jpg' style="width:500px">
  </div>
  
  <div class="mySlides fade">
    <img src="images/Annual.png" style="width:80%">
  </div>
  
  <div class="mySlides fade">
    <img src="images/Promotion.png" style="width:80%">
  </div>
  
  <div class="mySlides fade">
    <img src="images/Sales.png" style="width:80%">
  </div>

  </div>
        
   <br>
  
  <div style="text-align:center">
    <span class="dot"></span> 
    <span class="dot"></span> 
    <span class="dot"></span> 
    <span class="dot"></span>
  </div>
   
    <center>
   <table class='homepage_table'>
       <tr class='homepage_tr'>
           <?php
           (isset($_GET['user_id']))?
           $userID = trim($_GET['user_id']):
           $userID = "";
           echo "<td class='homepage_td'><a href='./flowers_gypsophila.php?user_id=$userID' class='homepage_a'><img src='image/gypsophila1a.jpg' height='250'/><br/><br/>View More Details &#128073;</a></td>";
           echo "<td class='homepage_td'><a href='./flowers_mixedFlower.php?user_id=$userID' class='homepage_a'><img src='image/mixedflower1a.jpg' height='250'/><br/><br/>View More Details &#128073;</a></td>";
           echo "<td class='homepage_td'><a href='./flowers_sunflower.php?user_id=$userID' class='homepage_a'><img src='image/sunflower1a.jpg' height='250'/><br/><br/>View More Details &#128073;</a></td>";
           echo "<td class='homepage_td'><a href='./flowers_tulip.php?user_id=$userID' class='homepage_a'><img src='image/tulip1a.jpg' height='250'/><br/><br/>View More Details &#128073;</a></td>";
           echo "<td class='homepage_td'><a href='./flowers_twistStick.php?user_id=$userID' class='homepage_a'><img src='image/twiststick1a.jpg' height='250'/><br/><br/>View More Details &#128073;</a></td>";
           ?>
       </tr>
   </table>
    </center>
    
    <table class="product2">
            <form method="post" action="">
                <?php 
define('DB_HOST', "yy-ver1-rds.ctqigw62kpxk.us-east-1.rds.amazonaws.com");
define('DB_USER', "yen0809");
define('DB_PASS', "p3TEr100");
define('DB_NAME', "PETER");
$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


$sql = "SELECT * FROM products";
if($result = $con->query($sql)){
                while($record = $result->fetch_object()){
                    (isset($_GET['user_id']))?
                    $userID = trim($_GET['user_id']):
                    $userID = "";
                        printf("
                        <table class='product2' style='width: 650px; height: 500px;'>
                        <tr class='tr1'>
                        <td class='td2'><center><a href='twistStick.php?id=%s&user_id=%s'><img src='uploaded_img/%s' height='350' alt='' class='product_img'></a></center></td>
                        </tr>
                        <tr class='tr1'>
                        <td class='td1'>%s<br/><br/>
                        <b style='font-size: 25px;'>RM %s.00</b>
                        <br/><br/><a href='twistStick.php?id=%s&user_id=%s' class='product1'>View More Details &#128073; </a></td>
                        <br/>
                        </tr>
                        </table>

                            ",$record->id,
                              $userID,
                              $record->image1,
                              $record->name,
                              $record->price,
                              $record->id,
                              $userID);
                }
            } 
            $result->free();
            $con->close();
?>
            </form>
        </table>
  
       <?php include './footer1.php'; ?>

   </body>
   
   
    <script>
    /SLIDESHOW/
    let slideIndex = 0;
    showSlides();
    
    function showSlides() {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 4000); // Change image every 4 seconds
    }
    </script>
</html>