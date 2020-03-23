<?php
$product = $data['product'];
?>
<section class="product">
    <div class="container product_main">
        <div class="breadcrumb">
            <span><a href="/">Главная</a></span>
            <span><a href="/">Каталог</a></span>
            <span><a href="/<?= $data['name_category'] ?>"><?= $data['name_category_rus']; ?></a></span>
            <span><?= $product['name']; ?></span>
        </div>
        <h1><?= $product['name']; ?></h1>
        <div class="row">
            <div class="col-lg-5 col-md-6 order-md-first image mb-5">
                <div class="product_img">
                    <img src="<?= $product['image']; ?>" alt="">
                </div>
            </div>
            <div class="col-lg-7 col-md-6 text-md-left text-left">
                <div class="product_price">Цена: <span><?= $product['price']; ?></span> <i class="fas fa-ruble-sign"></i></div>
                <div class="product_description">
                    <p><?= $product['description']; ?></p>
                </div>
                <div class="product_quantity">
                    <button class="p_minus">-</button><input type="text" class="quantity" id="p_quantity" value="1"><button class="p_plus">+</button>
                </div>
                <button class="add_to_cart" id="p_add_to_cart_<?= $product['id']; ?>"><img src="/img/Vector-white.png" alt=""> В корзину</button>
            </div>
            

        </div>
    </div>
    <div class="container product_characteristics">
        <h2>Характеристики</h2>
        <div class="row">
            <div class="col-auto">Назначение</div>
            <div class="col"></div>
            <div class="col-auto"><?= mb_strtolower($data['purpose']); ?></div>
        </div>
        <div class="row">
            <div class="col-auto">Производитель</div>
            <div class="col"></div>
            <div class="col-auto"><?= mb_strtoupper($data['manufacturer']); ?></div>
        </div>
    </div>
    <div class="container category">
        <h2>Похожие товары</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
            <?php foreach ($data['products'] as $product) : ?>
                <div class="col mb-5">
                    <div class="card tile">
                        <a href="/<?= $data['name_category'] . "/" . $product['id']; ?>">
                            <div class="tile_title">
                                <span class="card-title"><?= $product['name']; ?></span>
                            </div>
                            <div class="tile_img">
                                <img src="<?= $product['image']; ?>" class="card-img-top" alt="">
                            </div>
                        </a>
                        <div class="tile_buttons">
                            <button class="green"><?= $product['price']; ?> <i class="fas fa-ruble-sign"></i></button>
                            <button class="yellow" id="add_to_cart_<?= $product['id']; ?>"> <img src="/img/Vector-white.png" alt=""> Купить</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>