<?php
use Cake\Routing\Router;
use Cake\View\StringTemplate;
?>
<?php if(!empty($menu->menu_items)): ?>
    <?php
    if (!empty($menu->attributes)) {
        $stringTemplate = new StringTemplate();
        $attributes = ' ' . $stringTemplate->formatAttributes($menu->attributesAsArray);
    } else {
        $attributes = '';
    }
    ?>
    <ul<?php echo $attributes; ?>>
        <?php foreach($menu->menu_items as $item): ?>
            <li<?php echo ($this->request->here == Router::url($item->url)) ? ' class="active"' : ''; ?>>
                <?php echo $this->Html->link($item->title, $item->url, $item->attributesAsArray); ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>