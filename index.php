<?php
session_start();
require_once 'includes/connection.php';

?>

<?php
  
    if(isset($_GET['action']) && $_GET['action']=="add"){ 
          
        $id=intval($_GET['id']); 
          
        if(isset($_SESSION['cart'][$id])){ 
              
            $_SESSION['cart'][$id]['quantity']++; 
              
        }else{ 
              
            $sql_s="SELECT * FROM products
                WHERE id={$id}";
            $query_s=mysqli_query($connect, $sql_s); 
            if(mysqli_num_rows($query_s)!=0){ 
                $row_s=mysqli_fetch_array($query_s); 
                  
                $_SESSION['cart'][$row_s['id']]=array( 
                        "quantity" => 1, 
                        "price" => $row_s['price'] 
                    ); 
                  
                  
            }else{ 
                  
                $message="This product id it's invalid!"; 
                  
            } 
              
        } 
          
    } 
  
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>ВкусноБыстро</title>
		<link rel="stylesheet" href="css/style.css">

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@200;300;400;600;700;800&display=swap" rel="stylesheet">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;600;700;800;900&family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
	</head>
	
	<body>
		<?php 
		    echo "<h1>$message</h1>";
		?>
		<div class="wrapper">
			<header class="header">
					<div class="logo_mini">
						<img src="img/logo_mini.png" alt="Вкусно Быстро">
					</div>
					<nav class="menu_info">
						<ul class="menu_list">							
							<li class="menu_item"><a href="#footer_contacts">Доставка</a></li>
							<li class="menu_item"><a href="#footer_contacts">Оплата</a></li>
							<li class="menu_item"><a href="#footer_contacts">О нас</a></li>
							<li class="menu_item"><a href="#footer_contacts">Контакты</a></li>
						</ul>
					</nav>
					<div class="header_contacts">
						<span class="header_adress">ул. Просвещения 1</span>
						<span class="header_phone">8 800 000 00 00</span>
					</div>
					<div class="cart">
						<a href="/cart.php">
						<div class="cart_button">
							<div class="cart_info">
								<span>корзина</span>
							<!-- <span>|</span>
							<span>0</span> -->
							</div>
						</div>
						</a>
						<div class="cart_check">
							<?php

							if(isset($_SESSION['cart'])){							     
							$sql="SELECT * FROM products WHERE id IN (";							          
							        foreach($_SESSION['cart'] as $id => $value) { 
							            $sql.=$id.",";
							        }							          
							        $sql=substr($sql, 0, -1).") ORDER BY name ASC"; 
							        $query=mysqli_query($connect, $sql); 
							        $totalprice=0; 
							        while($row=mysqli_fetch_array($query)){ 
							            $subtotal=$_SESSION['cart'][$row['id']]['quantity']*$row['price']; 
							            $totalprice+=$subtotal; 
					        ?> 
					            
					        <?php 
					         
					        }     
					        } else {
					        	$totalprice = 0;
					        }
							?> 

							<span>Итого <?php echo $totalprice ?></span>	
						</div>
					</div>
			</header>

			<nav class="header_bottom">
				<ul class="main_menu">
					<li class="main_menu_item"><a href="#sushi">Суши</a></li>
					<li class="main_menu_item"><a href="#pizza">Пицца</a></li>
					<li class="main_menu_item"><a href="#burger">Бургеры</a></li>
					<li class="main_menu_item"><a href="#wok">Wok</a></li>
					<!-- <li class="main_menu_item"><a href="#dessert">Десерты</a></li> -->
					<li class="main_menu_item"><a href="#drinks">Напитки</a></li>
				</ul>
			</nav>
		</div>

		<div class="slider_main">
			<div class="slides">
				<div class="slide s1"><img src="img/main-slide1.png" alt="упс а где картинка?"></div>
				<div class="slide s2"><img src="img/main-slide2.png" alt="упс а где картинка?"></div>
				<div class="slide s3"><img src="img/main-slide3.png" alt="упс а где картинка?"></div>
				<div class="slide s3"><img src="img/main-slide4.png" alt="упс а где картинка?"></div>
			</div>
				<div class="navigation">
					<label class="bar"></label>
					<label class="bar"></label>
					<label class="bar"></label>
					<label class="bar"></label>
				</div>
		</div>

		<div class="wrapper">
			<div class="popular_info">
				<h2>Часто заказывают</h2>
				<div class="popular">
					<div class="popular_item"><img src="" alt=""></div>
					<div class="popular_item"><img src="" alt=""></div>
					<div class="popular_item"><img src="" alt=""></div>
					<div class="popular_item"><img src="" alt=""></div>
				</div>
			</div>
			<div class="logo_big">
				<img src="img/logo_big.png" alt="что-то должно быть">
			</div>
		</div>


		<div class="wrapper">
			<div class="table_product">		
				<h2 id="sushi">Суши</h2>
				<div class="product_card_list">


				<?php					  
					$sql="SELECT * FROM products where product_type = 'sushi' ORDER BY name ASC";  
					$query=mysqli_query($connect, $sql);
						      
					while ($row=mysqli_fetch_array($query)) { 
						          
					?>
					<div class="product_card">
						<div class="product_photo">
							<img src="img/sushi.png" alt="фото продукта">
						</div>
						<span class="product_name"><?php echo $row['name'] ?></span>
						<span class="product_description"><p><?php echo $row['description'] ?></p></span>
						<div class="product_amount_price">
							<!-- <div class="product_amount">
								<button class="minus">-</button>
								<span class="amount">1</span>
								<button class="plus">+</button>
							</div> -->
							<span class="product_price"><?php echo $row['price'] ?> P</span>
							<a class="add_to_bag" href="index.php?page=products&action=add&id=<?php echo $row['id'] ?>">в корзину</a>
						</div>
					</div>
					<?php 
						    } 
					?>
				</div>
			</div>

			<div class="table_product">			
				<h2 id="pizza">Пицца</h2>
				<div class="product_card_list">					
				<?php 
					$sql="SELECT * FROM products where product_type = 'pizza' ORDER BY name ASC"; 
					$query=mysqli_query($connect, $sql);
				while ($row=mysqli_fetch_array($query)) { 
				?>
					<div class="product_card">
						<div class="product_photo">
							<img src="img/pizza.png" alt="фото продукта">
						</div>
						<span class="product_name"><?php echo $row['name'] ?></span>
						<span class="product_description"><p><?php echo $row['description'] ?></p></span>
						<div class="product_amount_price">
							<!-- <div class="product_amount">
								<button class="minus">-</button>
								<span class="amount">1</span>
								<button class="plus">+</button>
							</div> -->
							<span class="product_price"><?php echo $row['price'] ?> P</span>
							<a class="add_to_bag" href="index.php?page=products&action=add&id=<?php echo $row['id'] ?>">в корзину</a>
						</div>
					</div>
				<?php 
					    } 
				?>
				</div>
			</div>

			<div class="table_product">			
				<h2 id="burger">Бургеры</h2>
				<div class="product_card_list">
					<?php 
						$sql="SELECT * FROM products where product_type = 'burger' ORDER BY name ASC"; 
						$query=mysqli_query($connect, $sql);
					while ($row=mysqli_fetch_array($query)) { 
					?>
					<div class="product_card">
						<div class="product_photo">
							<img src="img/burger.png" alt="фото продукта">
						</div>
						<span class="product_name"><?php echo $row['name'] ?></span>
						<span class="product_description"><p><?php echo $row['description'] ?></p></span>
						<div class="product_amount_price">
							<!-- <div class="product_amount">
								<button class="minus">-</button>
								<span class="amount">1</span>
								<button class="plus">+</button>
							</div> -->
							<span class="product_price"><?php echo $row['price'] ?> P</span>
							<a class="add_to_bag" href="index.php?page=products&action=add&id=<?php echo $row['id'] ?>">в корзину</a>
						</div>
					</div>
					<?php 
						    } 
					?>
				</div>
			</div>

			<div class="table_product">
				<h2 id="wok">Wok</h2>
				<div class="product_card_list">
					<?php 
						$sql="SELECT * FROM products where product_type = 'wok' ORDER BY name ASC";  
						$query=mysqli_query($connect, $sql);
					while ($row=mysqli_fetch_array($query)) { 
					?>
					<div class="product_card">
						<div class="product_photo">
							<img src="img/wok.png" alt="фото продукта">
						</div>
						<span class="product_name"><?php echo $row['name'] ?></span>
						<span class="product_description"><p><?php echo $row['description'] ?></p></span>
						<div class="product_amount_price">
							<!-- <div class="product_amount">
								<button class="minus">-</button>
								<span class="amount">1</span>
								<button class="plus">+</button>
							</div> -->
							<span class="product_price"><?php echo $row['price'] ?> P</span>
							<a class="add_to_bag" href="index.php?page=products&action=add&id=<?php echo $row['id'] ?>">в корзину</a>
						</div>
					</div>
					<?php 
						          
						    } 
						  
					?>
				</div>
			</div>

			<div class="table_product">
				<h2 id="drinks">Напитки</h2>
				<div class="product_card_list">
					<?php 
						$sql="SELECT * FROM products where product_type = 'drinks' ORDER BY name ASC";  
						$query=mysqli_query($connect, $sql);
					while ($row=mysqli_fetch_array($query)) { 
	          
					?>
					<div class="product_card">
						<div class="product_photo">
							<img src="img/drinks.png" alt="фото продукта">
						</div>
						<span class="product_name"><?php echo $row['name'] ?></span>
						<span class="product_description"><p><?php echo $row['description'] ?></p></span>
						<div class="product_amount_price">
							<!-- <div class="product_amount">
								<button class="minus">-</button>
								<span class="amount">1</span>
								<button class="plus">+</button>
							</div> -->
							<span class="product_price"><?php echo $row['price'] ?> P</span>
							<a class="add_to_bag" href="index.php?page=products&action=add&id=<?php echo $row['id'] ?>">в корзину</a>
						</div>
					</div>
					<?php 
						    } 
					?>
				</div>
			</div>

			<div class="block_info" id="block_info">
				<div class="block_info_item">
					<h2>Доставка</h2>
					<p>Lorem, ipsum dolor sit amet consectetur, adipisicing elit. Quisquam quo, reiciendis distinctio possimus harum nisi doloremque dolor iure eligendi esse?</p>
				</div>
				<div class="block_info_item">
					<h2>Оплата</h2>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste corrupti doloremque distinctio obcaecati qui commodi voluptatibus?</p>
				</div>
				<div class="block_info_item">
					<h2>О нас</h2>
					<p>Lorem, ipsum dolor, sit amet consectetur adipisicing elit. Rem, sequi explicabo, illo tenetur quo rerum perferendis, voluptate provident accusantium totam dolores omnis.</p>
				</div>
			</div>
		</div>

			<footer>
				<div class="wrapper_footer">
					<div class="logo_footer">
						<img src="img/logo_footer.svg" alt="logo_footer">
					</div>

					<div class="footer_contacts" id="footer_contacts">
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
			</footer>
	</body>
</html>