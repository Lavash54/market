<?php include "header.php"; include "dbcon.php"?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://it20/css/style.css">
    <link rel="stylesheet" href="http://it20/css/jquery.growl.css">
    <title>Product</title>
</head>
<body>
<?php
        $id_product = $_GET['product'];
        $sql = "SELECT * 
        from product
        WHERE product_id = $id_product";
        $result = mysqli_query($conn, $sql);
        $product = mysqli_fetch_array($result);
        if($product != NULL){
            $sql = "SELECT c.category_id, c.category_name
            FROM sub_category sc
            JOIN category c
            ON c.category_id = sc.category_id
            WHERE sc.product_id =".$product[1]."";
        $result = mysqli_query($conn, $sql);
        $category = mysqli_fetch_all($result);
        $sql = 'SELECT ap.product_id, ap.photo_id, p.alt_img, p.src_photo
                FROM photo p
                JOIN all_photo ap
                ON p.photo_id = ap.photo_id
                where ap.product_id = '.$product[0].'';
        $result = mysqli_query($conn, $sql);
        $photo = mysqli_fetch_all($result);
        if($product[4]!=NULL){
            $sql = 'SELECT * from promo where promo_id = '.$product[6].'';
            $result = mysqli_query($conn, $sql);
            $promo = mysqli_fetch_array($result);
        }
        }else {
            header("Location:http://it20/404.php");
        }
    ?>

    <div class="layout">
        <div class="product">
            <div class="product__img">
                <div class="product_preview">
                    <div class="product_preview-left">
                        <?php for($i = 0; $i < count($photo); $i++){
                                echo '<img src="'.$photo[$i][3].'" alt="'.$photo[$i][2].'" srcset="" class = "product_preview-left img" width="90px" height="130px">';
                            
                        }?>
                        <div class="product_preview-down">
                        </div>
                    </div>
                    <div class="product_preview-right">
                        <img src="<?php echo $photo[0][3]?>" alt="<?php echo $photo[0][2]?>" srcset="" class = "product_preview-right" width ="340px" height="492px">
                    </div>
                </div>
            </div>
            <div class="product_description">
                <h2 class="product_title"><?php echo $product[7]?></h2>

                <div class="product_categories">
                <?php for($i = 0; $i < count($category);$i++){
                            echo "<a href = 'http://it20/catalog.php/?catalog=".$category[$i][0]."'>".$category[$i][1]."</a></li>";
                    }?>
                
                </div>

                <div class="product_price">
                    <div class="product_price-actual">
                        <span class="product_price-old"><?php echo $product[3]?>₽</span>
                        <span class="product_price-current"><?php echo $product[2]?> ₽</span>
                        <?php if($promo[2] != NULL){
                            $sum = $product[2]-($product[2]*($promo[2]/100));
                            echo '<span class="product_price-discount">'.$sum.' ₽</span>
                            <span class="product_discount-text">— с промокодом</span>';
                        }else {
                            echo '
                            <span class="product_discount-value">промокода нет</span>';
                        }
                        ?> 
                    </div>
                </div>

                <div class="product_info">
                    <div class="product_info-item">
                        <img src="http://it20/img/check.png" alt="#"/>
                        В наличии в магазине  <a href="#">Lamoda </a>
                    </div>
                    <div class="product_info-item">
                        <img src="http://it20/img/car.png" alt="#"/>
                        Бесплатная доставка
                    </div>
                </div>

                <div class="product_action">

                    <div id="product_basket"></div>

                    <div id="counter">
                        <input type="button" id="buttonCountMinus" value="-">
                        <div id="buttonCountNumber">1</div>
                        <input type="button" id="buttonCountPlus" value="+">
                    </div>
                    <button class="custom-btn custom-btn--blue">в корзину</button>
                    <button class="custom-btn">в избранное</button>
                </div>

                <div class="product_text">
                    <p><?php echo $product[4]?>
                    </p>
                </div>

                <div class="product_share">
                    <span ckass="product_share-title">Поделиться: </span>
                    <div class="product_share-list">
                        <a href="#">
                            <img src="http://it20/img/vk.png" alt="#"/>
                        </a>
                        <a href="#">
                            <img src="http://it20/img/google-plus.png" alt="#"/>
                        </a>
                        <a href="#">
                            <img src="http://it20/img/facebook.png" alt="#"/>
                        </a>
                        <a href="#">
                            <img src="http://it20/img/twitter.png" alt="#"/>
                        </a>
                        <a href="#">
                        <span class="product_share-count">123</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>


<script src="http://it20/js/jquery-3.6.0.min.js"></script>
<script src="http://it20/js/jquery.growl.js"></script>

<script>
    $(".product_preview-left img").mouseover(function() {
        let src = $(this).attr("src");
        if(src == "./img/3.png"){
            src = "./img/1.png"
            $(".product_preview-right img").attr("src", src);
        } else {
            $(".product_preview-right img").attr("src", src);
        }
    })

    let count = $("#buttonCountNumber").text();
    $("#buttonCountMinus").css("color", "#d9d9d9");

    $("#buttonCountMinus").click(function(){
            if(count == 1){
                $("#buttonCountNumber").text(count);
            }else {
                count--;
                $("#buttonCountNumber").text(count);
                if(count == 1){
                    $("#buttonCountMinus").css("color", "#d9d9d9");
                }
            }
        })
        $("#buttonCountPlus").click(function(){
            count++;
            $("#buttonCountNumber").text(count);
            $("#buttonCountMinus").css("color", "#000");
        })

        $(".custom-btn--blue").click(function(){
            if(count == 1){
                $.growl({
            title:"Корзина",
            message:"Добавлен "+count+" товар"});
            } else if (count >= 2 && count < 5 ){
                $.growl({
            title:"Корзина",
            message:"Добавлено "+count+" товара"});
            } else {
                $.growl({
            title:"Корзина",
            message:"Добавлено "+count+" товаров"});
            }
            count = 1;
            $(".product_basket-count").text(count);
        })

</script>
</body>
</html>