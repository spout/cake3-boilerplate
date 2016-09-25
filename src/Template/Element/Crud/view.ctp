<?php if(!empty(${$viewVar})): ?>
    <dl class="dl-horizontal">
        <?php foreach($fields as $field => $label): ?>
            <dt><?php echo h($label); ?></dt>
            <dd><?php echo !empty(${$viewVar}[$field]) ? ${$viewVar}[$field] : '&mdash;'; ?></dd>
        <?php endforeach; ?>
    </dl>
<?php endif; ?>