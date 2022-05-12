<?php
session_start();
require_once 'includes/connection.php';

?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>ВкусноБыстро</title>
		<link rel="stylesheet" href="/css/style.css">

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@200;300;400;600;700;800&display=swap" rel="stylesheet">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;600;700;800;900&family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
	</head>

	<body>
        <div class="wrapper_cart">
            <header class="header header-cart">
                <div class="logo_mini">
                    <img src="img/logo_mini.png" alt="Вкусно Быстро">
                </div>
                <nav class="menu_main_page">
                    <ul class="menu_list">                          
                        <li class="menu_item"><a href="index.php">На главную</a></li>
                    </ul>
                </nav>
            </header>
        </div>

        <div class="wrapper_cart">
            <h1>Состав заказа</h1> 

            <?php

                if(isset($_SESSION['cart'])){

                $random_order_id = rand(9999, 99999);

                $sql="SELECT * FROM products WHERE id IN ("; 
                    foreach($_SESSION['cart'] as $id => $value){ 
                         $sql.=$id.",";
                    } 
                              
                $sql=substr($sql, 0, -1).") ORDER BY name ASC"; 
                $query=mysqli_query($connect, $sql); 
                $totalprice=0; 
                    while($row=mysqli_fetch_array($query)){ 
                        $subtotal=$_SESSION['cart'][$row['id']]['quantity']*$row['price']; 
                           $totalprice+=$subtotal; 
            ?> 
                               
            <form action="create_order.php" method="post">
                <div class="order_structure">
                	<div><?php echo $row['name'] ?></div>
                	<span><?php echo $_SESSION['cart'][$row['id']]['quantity'] ?> шт.</span>
                </div>

                <div class="product_id hidden">
                	<p>product_id</p>
                	<span><?php echo $row['id'] ?></span>
                </div>
                <?php 
                                  
                    }
                    }
                ?>

                <div class="total_price"> 
                    <td colspan="4"><p>Цена:</p><?php echo $totalprice ?> руб.</td> 
                </div> 
                
                <div class="order_id">
                    <input type="number" name="order_id" value="<?php echo $random_order_id ?>">
                </div>

                <button class="btn_cart" type="submit">Оформить заказ</button>
            </form>

            <form action="reset_session.php" method="post">
            	<button class="btn_cart">очистить</button>
            </form> 
            <br /> 
        </div>

        <div class="wrapper_cart">
            <div class="cart_footer">            
                <div class="footer_adress">
                    <span class="address">адрес:</span>
                    <span class="address_value">ул. Просвещения 1</span>
                </div>
                <div class="footer_phone">
                    <span class="phone">телефон:</span>
                    <span class="phone_value">8 800 000 00 00</span>
                </div>                
            </div>
        </div>
     </body>
</html>

        
            
