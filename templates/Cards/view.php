<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Card $card
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Card'), ['action' => 'edit', $card->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Card'), ['action' => 'delete', $card->id], ['confirm' => __('Are you sure you want to delete # {0}?', $card->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Cards'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Card'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="cards view content">
            <h3><?= h($card->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($card->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lane') ?></th>
                    <td><?= $card->has('lane') ? $this->Html->link($card->lane->name, ['controller' => 'Lanes', 'action' => 'view', $card->lane->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($card->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Position') ?></th>
                    <td><?= $this->Number->format($card->position) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($card->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($card->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Due Date') ?></th>
                    <td><?= h($card->due_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Archived') ?></th>
                    <td><?= $card->archived ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($card->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Checklists') ?></h4>
                <?php if (!empty($card->checklists)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Position') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Card Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($card->checklists as $checklists) : ?>
                        <tr>
                            <td><?= h($checklists->id) ?></td>
                            <td><?= h($checklists->position) ?></td>
                            <td><?= h($checklists->name) ?></td>
                            <td><?= h($checklists->card_id) ?></td>
                            <td><?= h($checklists->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Checklists', 'action' => 'view', $checklists->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Checklists', 'action' => 'edit', $checklists->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Checklists', 'action' => 'delete', $checklists->id], ['confirm' => __('Are you sure you want to delete # {0}?', $checklists->id)]) ?>
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
