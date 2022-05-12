
<?php
    require_once 'includes/connection.php';
    session_start();
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


        <div class="wrapper_cart">
            <header class="header header-cart">
                <div class="logo_mini">
                    <img src="img/logo_mini.png" alt="Вкусно Быстро">
                </div>
            </header>
        </div>

        <div class="wrapper_cart">            
            <h1>Заказ успешно оформлен!</h1>
            <h3><?php echo"Номер заказа: " .$_POST['order_id']; ?></h3>

            <?php       
                foreach($_SESSION['cart'] as $id => $value) {
                    $sql="INSERT INTO `order`(`order_id`, `product_id`, `product_quantity`) VALUES ('"
                    .$_POST['order_id'].
                    "','"
                    .$id.
                    "','"
                    .$value['quantity'].
                    "')";
                    $query=mysqli_query($connect, $sql);
                }
            ?>

            <form action="reset_session.php" method="post">
                <button class="btn_cart">На главную</button>
            </form>
        </div>
</html>