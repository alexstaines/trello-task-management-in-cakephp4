<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Checklist[]|\Cake\Collection\CollectionInterface $checklists
 */
?>
<div class="checklists index content">
    <?= $this->Html->link(__('New Checklist'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Checklists') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('position') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('card_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($checklists as $checklist): ?>
                <tr>
                    <td><?= $this->Number->format($checklist->id) ?></td>
                    <td><?= $this->Number->format($checklist->position) ?></td>
                    <td><?= h($checklist->name) ?></td>
                    <td><?= $checklist->has('card') ? $this->Html->link($checklist->card->name, ['controller' => 'Cards', 'action' => 'view', $checklist->card->id]) : '' ?></td>
                    <td><?= h($checklist->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $checklist->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $checklist->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $checklist->id], ['confirm' => __('Are you sure you want to delete # {0}?', $checklist->id)]) ?>
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
