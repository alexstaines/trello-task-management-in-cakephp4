<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Checklist $checklist
 * @var \Cake\Collection\CollectionInterface|string[] $cards
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Checklists'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="checklists form content">
            <?= $this->Form->create($checklist) ?>
            <fieldset>
                <legend><?= __('Add Checklist') ?></legend>
                <?php
                    echo $this->Form->control('position');
                    echo $this->Form->control('name');
                    echo $this->Form->control('card_id', ['options' => $cards]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
