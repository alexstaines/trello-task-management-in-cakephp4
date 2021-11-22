

<div class="row-lane row">
    <?php foreach ($lanes as $lane): ?>
        <div class="lane">
            <div class="card bg-light shadow border-0">
                <div class="card-header bg-light border-bottom-0"><h6 style="font-family: Arial, Helvetica, sans-serif"><?= $lane->name ?><h6></div>
                
                <div class="card-body bg-light p-2">
                    <?php foreach ($lane->cards as $card): ?>
                        <div class="card shadow border-0 m-1 mt-2">
                            <div class="card-header bg-white border-bottom-0">
                                <div class="row">
                                    <div class="col-sm">
                                        <?= $card->name ?>
                                    </div>
                                    <div class="col-sm">
                                        <a href="" class="float-end"><i class="fas fa-edit text-secondary"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                            </div>
                            <div class="card-footer"></div>
                            <a class="stretched-link" href="<?= $this->Url->build(['controller' => 'Cards', 'action' => 'view', $card->id]) ?>"></a>
                        </div>
                    <?php endforeach; ?>
                    <?= $this->Form->create(null, ['url' => ['controller' => 'Cards', 'action' => 'add', $lane->id]]); ?>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-outline-dark">+ Add card</button>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>


