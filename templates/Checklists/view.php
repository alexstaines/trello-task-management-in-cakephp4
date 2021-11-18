<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Checklist $checklist
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Checklist'), ['action' => 'edit', $checklist->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Checklist'), ['action' => 'delete', $checklist->id], ['confirm' => __('Are you sure you want to delete # {0}?', $checklist->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Checklists'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Checklist'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="checklists view content">
            <h3><?= h($checklist->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($checklist->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Card') ?></th>
                    <td><?= $checklist->has('card') ? $this->Html->link($checklist->card->name, ['controller' => 'Cards', 'action' => 'view', $checklist->card->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($checklist->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Position') ?></th>
                    <td><?= $this->Number->format($checklist->position) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($checklist->created) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Checklist Items') ?></h4>
                <?php if (!empty($checklist->checklist_items)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Position') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Checklist Id') ?></th>
                            <th><?= __('State') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($checklist->checklist_items as $checklistItems) : ?>
                        <tr>
                            <td><?= h($checklistItems->id) ?></td>
                            <td><?= h($checklistItems->position) ?></td>
                            <td><?= h($checklistItems->name) ?></td>
                            <td><?= h($checklistItems->checklist_id) ?></td>
                            <td><?= h($checklistItems->state) ?></td>
                            <td><?= h($checklistItems->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ChecklistItems', 'action' => 'view', $checklistItems->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ChecklistItems', 'action' => 'edit', $checklistItems->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ChecklistItems', 'action' => 'delete', $checklistItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $checklistItems->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
