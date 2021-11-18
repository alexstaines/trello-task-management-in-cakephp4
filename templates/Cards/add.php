<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Card $card
 * @var \Cake\Collection\CollectionInterface|string[] $lanes
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Cards'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="cards form content">
            <?= $this->Form->create($card) ?>
            <fieldset>
                <legend><?= __('Add Card') ?></legend>
                <?php
                    echo $this->Form->control('position');
                    echo $this->Form->control('name');
                    echo $this->Form->control('lane_id', ['options' => $lanes]);
                    echo $this->Form->control('description');
                    echo $this->Form->control('due_date');
                    echo $this->Form->control('archived');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
