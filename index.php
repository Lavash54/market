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
    <link rel="stylesheet" href="css/index.css">
    <title>Document</title>
</head>
<body>
    <main>
        <h3>Выберите категорю товара</h3>
        <div class="catalog">
            
            <?php 
                $sql = "SELECT c.category_id, c.category_name, count(*) as product_id 
                FROM sub_category sb 
                JOIN category c 
                ON c.category_id = sb.category_id 
                GROUP BY c.category_name, c.category_id
                ORDER BY c.category_name DESC";
                $result= mysqli_query($conn,$sql);
                $category_value = mysqli_fetch_all($result);
                for($i = 0; $i < count($category_value); $i++){
                    for($j = 1; $j < 3; $j++){
                        if($j == 2){
                            echo "в наличий (",$category_value[$i][$j], ")</a></p>";
                        }else{
                            echo '<p id= "catalog_item" class = "catalog_item"><a href = "catalog.php/?catalog='.$category_value[$i][0].'">',$category_value[$i][$j], " ";
                        }
                    }
                    echo '<br>';
                }
            ?>
            </div>
    </main>
   
</body>
</html>