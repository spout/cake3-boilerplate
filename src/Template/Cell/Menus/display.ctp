<?php if(!empty($menus)): ?>
    <ul>
        <?php foreach($menus as $menu): ?>
            <li><?php echo $this->Html->link($menu->title, $menu->url); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
