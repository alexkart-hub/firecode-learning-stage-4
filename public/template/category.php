<?php
$category = $data['category'];
?>
<section class="category">
    <div class="container">
        <div class="breadcrumb">
            <span><a href="/">Главная</a></span>
            <span><a href="/">Каталог</a></span>
            <span>Корм <?= mb_strtolower($category['name']); ?></span>
        </div>
        <h1>Корм <?= mb_strtolower($category['name']); ?></h1>
        <?php include "module/pagination.php"; ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
            <?php foreach ($data['products'] as $product) :
                if ($product['id_section'] == $category['id']) :
            ?>
                    <div class="col mb-5">
                        <div class="card tile">
                            <a href="/<?= translit("Корм " . $category['name']) . "/" . $product['id']; ?>">
                                <div class="tile_title">
                                    <span class="card-title"><?= $product['name']; ?></span>
                                </div>
                                <div class="tile_img">
                                    <img src="<?= $product['image'] ?>" class="card-img-top" alt="">
                                </div>
                            </a>
                            <div class="tile_buttons">
                                <button class="green"><?= $product['price'] ?> <i class="fas fa-ruble-sign"></i></button>
                                
                                <!-- <a href="/<?//= translit("Корм " . $category['name']) . "?page=".$data['page']['number']?>"> -->
                                    <button class="yellow" id="add_to_cart_<?= $product['id']; ?>"> <img src="/img/Vector-white.png" alt=""> Купить</button>
                                <!-- </a> -->
                            </div>
                        </div>
                    </div>
            <?php endif;
            endforeach; ?>
        </div>

        <?php include "module/pagination.php"; ?>
    </div>
</section>