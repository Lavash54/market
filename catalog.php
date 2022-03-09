<?php 
include "header.php";
include "dbcon.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://it20/css/catalog.css">
</head>
<body>
    <main>
    <div class = "card">
        <?php
            $id_catalog = $_GET['catalog'];
            $sql = "SELECT sp.category_id, p.product_id, p.photo_id,p.product_name, p.product_description
            FROM sub_category sp
            JOIN product p
            ON  sp.product_id = p.product_id
            WHERE sp.category_id = $id_catalog";
            $result= mysqli_query($conn,$sql);
            $catalog = mysqli_fetch_all($result);
            if($catalog != NULL) {
                $sql = "SELECT category_name
                from category
                WHERE category_id = $id_catalog";
            $result= mysqli_query($conn,$sql);
            $category_name = mysqli_fetch_array($result); 
            echo '<h2>'.$category_name[0].'</h2>';
            for($i = 0; $i < count($catalog); $i++){
                for ($j = 2; $j < 5; $j++){
                    if ($j == 2){
                        $sql = "SELECT ph.alt_img, ph.src_photo
                        FROM product p
                        JOIN photo ph 
                        ON ph.photo_id = p.photo_id
                        WHERE p.photo_id = ".$catalog[$i][$j]."";
                        $result1= mysqli_query($conn,$sql);
                        $photo = mysqli_fetch_all($result1);
                    }

                    if ($j == 3) {
                    
                        echo '<div class = "card_block">
                        <a href="http://it20/product.php/?product='.$catalog[$i][1].'">
                            <img src="'.$photo[0][1].'" alt="'.$photo[0][0].'" srcset="" width="200px" height="200px">
                            <p class="card_name">'.$catalog[$i][$j].'</p>
                        </a>
                    </div>';
                    }
                    }
                }
                }else {
                    header("Location:http://it20/404.php");
                }
                
            ?>
    </div>    
    </main>
    
</body>
</html>