<?php
$category = $data['category'];
// debug($data['products']);
// debug($data);
?>
<section class="category">
    <div class="container">
        <div class="breadcrumb">
            <span><a href="/">Главная</a></span>
            <span><a href="/">Каталог</a></span>
            <span>Корм <?= mb_strtolower($category['name']); ?></span>
        </div>
        <h1>Корм <?= mb_strtolower($category['name']); ?></h1>
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
                                    <img src="<?= $product['image'] ?>" class="card-img-top p-2" alt="">
                                </div>
                            </a>
                            <div class="tile_buttons">
                                <button class="green"><?= $product['price'] ?> <i class="fas fa-ruble-sign"></i></button>
                                <button class="yellow"> <img src="/img/Vector-white.png" alt=""> Купить</button>
                            </div>
                        </div>
                    </div>
            <?php endif;
            endforeach; ?>
        </div>

        <div class="container pagination justify-content-center">
            <div class="row">
                <div class="col grey"><i class="fas fa-angle-left "></i></div>
                <a href="#">
                    <div class="col green">1</div>
                </a>
                <a href="#">
                    <div class="col green">2</div>
                </a>
                <a href="#">
                    <div class="col green">3</div>
                </a>
                <a href="#">
                    <div class="col green">4</div>
                </a>
                <a href="#">
                    <div class="col green">5</div>
                </a>
                <a href="#">
                    <div class="col green"><i class="fas fa-angle-right "></i></div>
                </a>
            </div>
        </div>
    </div>
</section>