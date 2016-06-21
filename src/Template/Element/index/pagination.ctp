<div class="row">
    <div class="col-md-12">
        <?php
        if ($this->Paginator->hasPage(2)) {
            echo $this->Paginator->numbers([
                'prev' => true,
                'next' => true,
            ]);
        }
        ?>
        <?php echo $this->Paginator->counter(__('{{start}} - {{end}} of {{count}}'));?>
    </div>
</div>
