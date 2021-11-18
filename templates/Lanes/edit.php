<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lane $lane
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $lane->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $lane->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Lanes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="lanes form content">
            <?= $this->Form->create($lane) ?>
            <fieldset>
                <legend><?= __('Edit Lane') ?></legend>
                <?php
                    echo $this->Form->control('position');
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
