<?php

use app\classes\cart\Cart;

$products = $data['cart']['products'];
$total_price = $data['cart']['total_price'];
// debug(Cart::GetInstance()->getCart());
?>
<section class="cart">
    <div class="container">
        <div class="breadcrumb">
            <span><a href="/">Главная</a></span>
            <span>Корзина</span>
        </div>
        <h1>Корзина</h1>
    </div>
    <div class="container table">
        <div class="row title">
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-md-2 id_title order-md-1">ID</div>
                    <div class="col-md-7 name_title order-md-3">Наименование</div>
                    <div class="col-md-3 photo_title order-md-2">Фото</div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-md-3 price_title">Цена</div>
                    <div class="col-md-4 quantity_title">Количество</div>
                    <div class="col-md-3 total_title">Сумма</div>
                    <div class="col-md-2 delete_title"></div>
                </div>
            </div>
        </div>
        <?php foreach ($products as $product) :
            extract($product);
        ?>
            <div class="row item">
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-md-2 id_item order-md-1">
                            <div class="f"><?= $product['id']; ?></div>
                        </div>
                        <div class="col-md-7 name_item order-md-3">
                            <div class="f"><?= $product['name']; ?></div>
                        </div>
                        <div class="col-md-3 photo_item order-md-2"><img src="<?= $product['image']; ?>" alt=""></div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-md-3 price_item">
                            <div class="f"> <?= $product['price']; ?> р.</div>
                        </div>
                        <div class="col-md-4 quantity_item">
                            <div class="f">
                                <div class="product_quantity">
                                    <button class="minus" id="decrease_<?= $product['id']; ?>">-</button><input type="text" class="quantity" id="quantity_<?= $product['id']; ?>" value=<?= $count; ?>><button class="plus" id="increase_<?= $product['id']; ?>">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 total_item total_item_<?= $product['id']; ?>">
                            <div class="f"> <?= $count * $product['price']; ?> р.</div>
                        </div>
                        <div class="col-md-2 delete_item" id="delete_<?= $product['id']; ?>">
                            <div class="f"> <i class="fas fa-times"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="container cart_down">
        <div class="row">
            <div class="col-md-auto text-center">
                <button id="clear_cart">Очистить корзину</button>
            </div>
            <div class="col-md"></div>
            <div class="col-md-auto text-center">
                <div class="product_price">Итого: <span><?= $total_price; ?></span> <i class="fas fa-ruble-sign"></i></div>
            </div>
        </div>
    </div>
</section>