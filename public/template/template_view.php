<?php

use app\classes\cart\Cart;
use app\classes\db\DbMysqli;
use app\classes\Product;

$cart = Cart::GetInstance();
$cart = $cart->GetCart();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $price = Product::GetPrice($_GET['id'], DbMysqli::GetInstance());
    $cart['price'] = $price * $cart['cart'][$id];
    $cart['id'] = $id;
    echo $dataOut = json_encode($cart);
    die;
}
// debug($cart);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE11">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&display=swap&subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/normalize.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="/css/adaptive.css?<?php echo time(); ?>">
    <title>PetShop</title>
</head>

<body>
    <section class="header">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand logo" href="/">
                <img src="/img/logo.png" alt="">
            </a>
            <a class="navbar-brand cart" href="/cart">
                <div class="cart_total">
                    <p>Корзина</p>
                    <p>Сумма: <span><?= $cart['total_price']; ?> </span><i class="fas fa-ruble-sign"></i> </p>
                </div>
                <div class="cart_quantity"><?= $cart['count']; ?></div>
                <img src="/img/Vector.png" alt="">
            </a>
        </div>
        <div class="header_bottom">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon mt-2"><i class="fas fa-bars"></i></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="/">Главная</a>
                            </li>
                            <?php foreach ($data['categories'] as $category) : ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/<?= translit('Корм ' . $category['name']); ?>">Корм <?= mb_strtolower($category['name']); ?></a>
                                </li>
                            <? endforeach; ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </section>
    <!-- ====================== Content ============================== -->
    <?php include TEMPLATE_PATH . $content_view; ?>
    <!-- ====================== /Content ============================= -->
    <section class="footer">
        <div class="nav_bottom">
            <div class="container">
                <nav class="navbar navbar-expand-md">
                    <a class="navbar-brand" href="#">
                        <img src="/img/logo.png" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav justify-content-between">
                            <a class="nav-item nav-link" href="/">Каталог:</a>
                            <?php foreach ($data['categories'] as $category) : ?>
                                <a class="nav-item nav-link" href="/<?= translit('Корм ' . $category['name']); ?>"><?= $category['name']; ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </section>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/276549fad6.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>