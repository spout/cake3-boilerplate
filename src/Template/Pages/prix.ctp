<?php $this->append('css'); ?>
    <style>
        div.checkbox {
            margin-top: 0;
            margin-bottom: 4px;
        }

        td.shippingfees {
            min-width: 120px;
        }

        td.packaging-type label,
        td.packaging-unit label {
            width: 100%;
            margin-bottom: 0;
        }
    </style>
<?php $this->end(); ?>

<div class="table-responsive">
    <table class="table table-condensed table-bordered">
        <thead>
            <tr>
                <th rowspan="2">Marque</th>
                <th colspan="2" class="text-center">Prix TVA incl.</th>
                <th colspan="2" class="text-center">Date promo</th>
                <th rowspan="2">Frais de caution</th>
                <th rowspan="2">Frais de livraison</th>
                <th colspan="5" class="text-center">Conditionnement</th>
                <th rowspan="2">Actions</th>
            </tr>
            <tr>
                <th>Prix</th>
                <th>Promo</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Type</th>
                <th>Quantité</th>
                <th>Poids</th>
                <th>Unité</th>
                <th>Sacs</th>
            </tr>
        </thead>
        <tbody>
            <?php for($i = 0; $i < 5; $i++): ?>
                <tr>
                    <td>
                        <?php echo $this->Form->select('brand.' . $i, ['Marque A', 'Marque B', 'Marque C'], ['empty' => '-']); ?>
                    </td>
                    <td>
                        <?php echo $this->Form->text('price.' . $i); ?>
                    </td>
                    <td>
                        <?php echo $this->Form->text('promo.' . $i); ?>
                    </td>
                    <td>
                        <?php echo $this->Form->text('promo_date_start.' . $i); ?>
                    </td>
                    <td>
                        <?php echo $this->Form->text('promo_date_end.' . $i); ?>
                    </td>
                    <td>
                        <?php echo $this->Form->text('returnable_fee.' . $i); ?>
                    </td>
                    <td class="shippingfees">
                        <?php echo $this->Form->input('shippingfees.' . $i, ['multiple' => 'checkbox', 'label' => false, 'options' => ['Livraison A', 'Livraison B', 'Livraison C']]); ?>
                    </td>
                    <td class="packaging-type">
                        <?php echo $this->Form->radio('packaging_type.' . $i, ['Big-bag', 'Palette', 'Sac', 'Vrac']); ?>
                    </td>
                    <td>
                        <?php echo $this->Form->text('packaging_quantity.' . $i); ?>
                    </td>
                    <td>
                        <?php echo $this->Form->text('packaging_weight.' . $i); ?>
                    </td>
                    <td class="packaging-unit">
                        <?php echo $this->Form->radio('packaging_unit.' . $i, ['Kg', 'Pound', 'Tonne']); ?>
                    </td>
                    <td>
                        <?php echo $this->Form->text('packaging_bags.' . $i); ?>
                    </td>
                    <td>
                        <?php echo $this->Form->input('active.' . $i, ['label' => 'Actif', 'type' => 'checkbox']); ?>
                        <?php echo $this->Form->input('delete.' . $i, ['label' => 'Supprimer', 'type' => 'checkbox']); ?>
                    </td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>