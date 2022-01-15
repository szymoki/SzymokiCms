<?php foreach ($page_config->page_left_boxes as $item): ?>
<div class="one-third color-<?= $item["color"] ?> animate-box">
    <span class="icon"><i class="flaticon-<?= $item["icon"] ?>"></i></span>
    <div class="desc">
        <h3>
            <?= $item["text"] ?>
        </h3>
        <p><a href="<?= base_url($item["url"]) ?>" class="view-more">Czytaj więcej</a></p>
    </div>
</div>
<?php endforeach; ?>