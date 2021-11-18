<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ChecklistItem[]|\Cake\Collection\CollectionInterface $checklistItems
 */
?>
<div class="checklistItems index content">
    <?= $this->Html->link(__('New Checklist Item'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Checklist Items') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('position') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('checklist_id') ?></th>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($checklistItems as $checklistItem): ?>
                <tr>
                    <td><?= $this->Number->format($checklistItem->id) ?></td>
                    <td><?= $this->Number->format($checklistItem->position) ?></td>
                    <td><?= h($checklistItem->name) ?></td>
                    <td><?= $checklistItem->has('checklist') ? $this->Html->link($checklistItem->checklist->name, ['controller' => 'Checklists', 'action' => 'view', $checklistItem->checklist->id]) : '' ?></td>
                    <td><?= h($checklistItem->state) ?></td>
                    <td><?= h($checklistItem->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $checklistItem->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $checklistItem->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $checklistItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $checklistItem->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
