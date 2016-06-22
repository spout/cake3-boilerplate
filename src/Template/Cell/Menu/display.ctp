<?php if(!empty($menu->menu_items)): ?>
    <ul>
        <?php foreach($menu->menu_items as $item): ?>
            <li>
                <?php echo $this->Html->link($item->title, $item->url); ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
