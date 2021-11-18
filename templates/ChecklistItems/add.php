<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ChecklistItem $checklistItem
 * @var \Cake\Collection\CollectionInterface|string[] $checklists
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Checklist Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="checklistItems form content">
            <?= $this->Form->create($checklistItem) ?>
            <fieldset>
                <legend><?= __('Add Checklist Item') ?></legend>
                <?php
                    echo $this->Form->control('position');
                    echo $this->Form->control('name');
                    echo $this->Form->control('checklist_id', ['options' => $checklists]);
                    echo $this->Form->control('state');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
