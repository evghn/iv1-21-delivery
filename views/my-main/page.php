<?php

use yii\bootstrap5\Carousel;
?>
<div>
    <img src="<?= $imageFile ?>" alt="" class="w-25">

    <?= 
    Carousel::widget([
        'items' => [
            // the item contains only the image
            '<img src="https://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-01.jpg"/>',
            // equivalent to the above
            ['content' => '<img src="https://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-02.jpg"/>'],
            // the item contains both the image and the caption
            [
                'content' => '<img src="https://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-03.jpg"/>',
                'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
                'captionOptions' => ['class' => ['d-none', 'd-md-block']],
                'options' => [],
            ],
        ]
    ]);
    ?>
</div>