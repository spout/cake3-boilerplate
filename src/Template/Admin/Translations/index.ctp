<?php
//pr($files);
//pr($entries);
?>

<?php if(!empty($files)): ?>
    <table class="table table-condensed table-bordered table-striped">
        <tbody>
            <?php foreach($files as $f): ?>
                <tr>
                    <td><?php echo $this->Html->link($f, '#'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php if(!empty($entries)): ?>
    <?php
    $cols = [
        'msgid' => __("Original"),
        'msgstr' => __("Translated"),
        'reference' => __("Reference"),
    ];
    ?>
    <table class="table table-condensed table-bordered table-striped">
        <thead>
            <tr>
                <?php foreach($cols as $col => $label): ?>
                    <th><?php echo $label; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($entries as $entry): ?>
                <tr>
                    <?php foreach($cols as $col => $label): ?>
                        <td>
                            <?php
                            $val = !empty($entry[$col]) ? implode('<br>', $entry[$col]) : '&mdash;';
                            //switch ($col) {
                            //    case 'reference':
                            //        break;
                            //
                            //    default:
                            //        echo $this->Form->input();
                            //        break;
                            //}
                            ?>
                            <?php echo $val; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
