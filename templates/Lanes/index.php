

<div class="row-lane row">
    <?php foreach ($lanes as $lane): ?>
        <div class="lane">
            <div class="card bg-light shadow border-0">
                <div class="card-header bg-light border-bottom-0"><h6 style="font-family: Arial, Helvetica, sans-serif"><?= $lane->name ?><h6></div>
                
                <div class="card-body bg-light p-2">
                    <?php foreach ($lane->cards as $card): ?>
                        <div class="card-clicked card shadow border-0 m-1 mt-2">
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
                            <a class="stretched-link" id="cardOpen" onclick="getCard(null,<?= $card->id ?>,'get')" data-id="<?= $card->id ?>" data-action="get" data-bs-toggle="modal" data-bs-target="#cardClick"></a>
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

<!-- Modals -->

<!-- Card Click -->
<div class="modal modal-dialog-scrollable fade" id="cardClick">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cardTitle">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>


<script>
  

    // $('.card-clicked').click(function() {
    //     id = $(this).data("id");
    //     alert(id);
    // })
    function getCard(url, id, action) {
        $.ajax({
            url: "<?= $this->Url->build(['controller' => 'Cards', 'action' => 'index']) ?>",
            type: "POST", //request type
            data: {
                "action" : action,
                "id": id
            },
            headers: {
                "X-CSRF-Token":$('[name="_csrfToken"]').val()
            },
            success: function(result_json) {
                result = JSON.parse(result_json);

                if (action == 'get') {
                    //fill fields
                    document.getElementById('cardTitle').innerHTML = result['name'];
                
                }
            }
        });
    }
    

</script>


