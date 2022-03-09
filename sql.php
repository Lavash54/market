<?php include "dbcon.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
</head>
<body>
    <?php 
        $sql = "SELECT c.category_id, c.category_name, count(*) as product_id 
        FROM sub_category sc
        JOIN category c 
        ON c.category_id = sc.category_id 
        GROUP BY c.category_name, c.category_id
        ORDER BY c.category_name DESC";
        $result= mysqli_query($conn,$sql);
        $category_value = mysqli_fetch_all($result);
        for($i = 0; $i < count($category_value); $i++){
            for($j = 1; $j < 3; $j++){
                if($j == 2){
                    echo "(",$category_value[$i][$j], ")";
                }else{
                    echo $category_value[$i][$j], " ";
                }
            }
            echo '<br>';
        }
        echo "<br>";
        $sql = "SELECT sc.category_id, p.product_id, p.product_name, p.product_count
        FROM sub_category sc
        JOIN product p
        ON  sc.product_id = p.product_id";
        $result= mysqli_query($conn,$sql);
        $category_value = mysqli_fetch_all($result);
        for($i = 0; $i < count($category_value); $i++){
            for($j = 0; $j < 4; $j++){
                echo $category_value[$i][$j], " ";
            }
            echo '<br>';
        }
        echo "<br>";
        $sql = "SELECT pp.product_id, pp.photo_id, p.alt_img, p.src_photo FROM photo p JOIN photo_product pp ON p.photo_id = pp.photo_id";
        $result= mysqli_query($conn,$sql);
        $category_value = mysqli_fetch_all($result);
        for($i = 0; $i < count($category_value); $i++){
            for($j = 0; $j < 4; $j++){
                echo $category_value[$i][$j], " ";
            }
            echo '<br>';
        }
        echo "<br>";
        $sql = "SELECT * from product";
        $result= mysqli_query($conn,$sql);
        $category_value = mysqli_fetch_all($result);
        foreach ($category_value as $item) {
            echo $item, '<br>';
        }
    ?>
</body>
</html>
