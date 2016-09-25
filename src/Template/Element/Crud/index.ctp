<?php
use Cake\Routing\Router;

?>
<?php if(!empty(${$viewVar})): ?>
    <?php
    if (empty($fields['actions'])) {
        $fields['actions'] = __("Actions");
    }

    $fieldsElements = [];
    foreach ($fields as $field => $label) {
        $element = $this->request->params['controller'] . '/fields/' . $field;
        $elementFilename = APP . 'Template/Element/'. $element . '.ctp';
        if (file_exists($elementFilename)) {
            $fieldsElements[$field] = $element;
        }
    }
    ?>
    <?php if(!isset($add) || $add !== false): ?>
        <p>
            <a href="<?php echo Router::url(['action' => 'add']); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i> <?php echo __("Add"); ?>
            </a>
        </p>
    <?php endif; ?>

    <p>
        <?php echo $this->Paginator->counter(__("{{start}} - {{end}} of {{count}}")); ?>
    </p>

    <div class="table-responsive">
        <table class="table table-condensed table-striped">
            <thead>
                <tr>
                    <?php foreach($fields as $field => $label): ?>
                        <th><?php echo $this->Paginator->sort($field, $label); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach(${$viewVar} as $singularVar): ?>
                    <tr>
                        <?php foreach($fields as $field => $label): ?>
                            <td>
                                <?php
                                if (!empty($fieldsElements[$field])) {
                                    echo $this->element($fieldsElements[$field], compact('singularVar'));
                                } else {
                                    if ($field == 'actions') {
                                        echo $this->element('Crud/fields/actions', compact('singularVar'));
                                    } else {
                                        echo $singularVar[$field];
                                    }
                                }
                                ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php echo $this->Paginator->numbers(); ?>
<?php endif; ?>
