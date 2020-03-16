<?php
$categories = $data['categories'];
?>
<section class="main">
    <div class="container">
        <h1>Каталог</h1>
        <div class="row">
            <?php foreach ($categories as $category) : ?>
                <div class="col-lg-3 col-sm-6 col-12 section">
                    <div class="wrap wrap1">
                        <p class="section_title">Корм <?= mb_strtolower($category['name']); ?></p>
                        <img src="/img/<?= translit($category['name']); ?>.png" alt="">
                        <form action="/" method="POST">
                            <input type="submit" value="Подробнее">
                            <input type="hidden" name="id" value="<?= $category['id']; ?>">
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>