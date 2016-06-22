<?php
use Cake\Routing\Router;
?>
<?php if(!empty($menu->menu_items)): ?>
    <?php
    if (!empty($menu->attributes)) {
        $attributes = [];
        foreach ($menu->attributes as $k => $v) {
            $attributes[] = sprintf('%s="%s"', $k, $v);
        }
        $attributes = ' ' . implode(' ', $attributes);
    } else {
        $attributes = '';
    }
    ?>
    <ul<?php echo $attributes; ?>>
        <?php foreach($menu->menu_items as $item): ?>
            <li<?php echo ($this->request->here == Router::url($item->url)) ? ' class="active"' : ''; ?>>
                <?php echo $this->Html->link($item->title, $item->url, $item->attributes); ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>