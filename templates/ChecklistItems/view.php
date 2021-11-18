<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ChecklistItem $checklistItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Checklist Item'), ['action' => 'edit', $checklistItem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Checklist Item'), ['action' => 'delete', $checklistItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $checklistItem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Checklist Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Checklist Item'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="checklistItems view content">
            <h3><?= h($checklistItem->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($checklistItem->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Checklist') ?></th>
                    <td><?= $checklistItem->has('checklist') ? $this->Html->link($checklistItem->checklist->name, ['controller' => 'Checklists', 'action' => 'view', $checklistItem->checklist->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($checklistItem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Position') ?></th>
                    <td><?= $this->Number->format($checklistItem->position) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($checklistItem->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= $checklistItem->state ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
