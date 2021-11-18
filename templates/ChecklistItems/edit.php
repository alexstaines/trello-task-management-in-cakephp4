<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ChecklistItem $checklistItem
 * @var string[]|\Cake\Collection\CollectionInterface $checklists
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $checklistItem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $checklistItem->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Checklist Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="checklistItems form content">
            <?= $this->Form->create($checklistItem) ?>
            <fieldset>
                <legend><?= __('Edit Checklist Item') ?></legend>
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
