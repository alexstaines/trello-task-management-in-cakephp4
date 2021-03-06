<?=$this->Html->css('custom-drag-drop.css', ['block'=> true])?>
<?=$this->Html->script('custom-drag-drop.js', ['block'=>'scriptBottom'])?>



<div class="row-lane row">
    <?php foreach ($lanes as $lane): ?>
        <div class="lane">
            <div class="card bg-light shadow border-0">
                <div class="card-header bg-light border-bottom-0"><h6 style="font-family: Arial, Helvetica, sans-serif"><?= $lane->name ?><h6></div>
                
                <div class="card-body bg-light p-2">
                    <?php foreach ($lane->cards as $card): ?>
                        <div class="cursor-pointer card shadow border-0 m-1 mt-2 draggable" draggable="true">
                            <div class="card-header bg-white border-bottom-0">
                                <div class="row">
                                    <div class="col-sm">
                                        <?= $card->name ?>
                                        <?= $card->position ?>
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
                        <button type="submit" class="btn btn-outline-secondary border-0">+ Add card</button>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title cursor-pointer" id="cardTitle"></h4>
                <form method="post" id="editCardTitleForm" style="display:none;">
                    <div style="display:none"><input style="display:none" name="_csrfToken" value=<?= $this->request->getAttribute('csrfToken')?>></input></div>
                    
                    <input name="name" class="form-control" id="cardTitleInput" required></input>
                    <button class="btn btn-sm btn-primary" type="submit">Save</button>
                    <button type="button" class="btn-close" id="cardTitleClose"></button>
                
                
                </form>

                <div id="skeletonTitle" class="skeleton skeleton-header skeleton-title"></div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Description</h5>
                <div class="cursor-pointer" id="description"></div>
                <div class="skeleton skeleton-text"></div>
                <div class="skeleton skeleton-text"></div>

                <form method="post" id="editDescriptionForm" style="display:none;">
                    <div style="display:none"><input style="display:none" name="_csrfToken" value=<?= $this->request->getAttribute('csrfToken')?>></input></div>
                    
                    <textarea name="description" class="form-control" id="descriptionInput" required></textarea>
                    <button class="btn btn-sm btn-primary" type="submit">Save</button>
                    <button type="button" class="btn-close" id="descriptionClose"></button>
                
                
                </form>

                <br>
                
                <h5>Checklists</h5>
                <div id="checklistList"></div>
   
                <div class="skeleton skeleton-text"></div>
                <div class="skeleton skeleton-text"></div>
                
                <div id="newChecklist" class="cursor-pointer">+ New Checklist</div>
                <form method="post" id="newChecklistForm" style="display:none;">
                    <div style="display:none"><input style="display:none" name="_csrfToken" value=<?= $this->request->getAttribute('csrfToken')?>></input></div>
                    
                    <input name="name" class="form-control" required placeholder="New Checklist"></input>
                    <button class="btn btn-sm btn-primary" type="submit">Add</button>
                    <button type="button" class="btn-close" id="newChecklistInputClose"></button>
                
                </form>
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
        //click to show editable text box
        $("#cardTitle, #cardTitleClose").click( function(e){
            $("#editCardTitleForm").toggle();
            $("#cardTitle").toggle();
            //fixes issue with click event being called twice every 2nd time modal is opened, and event is clicked
            e.stopImmediatePropagation()
        });
        $("#description, #descriptionClose").click( function(e){
            $("#editDescriptionForm").toggle();
            $("#description").toggle();
            //fixes issue with click event being called twice every 2nd time modal is opened, and event is clicked
            e.stopImmediatePropagation()
        });
        $("#newChecklist, #newChecklistInputClose").click( function(e){
            $("#newChecklistForm").toggle();
            $("#newChecklist").toggle();
            //fixes issue with click event being called twice every 2nd time modal is opened, and event is clicked
            e.stopImmediatePropagation()
        });

        //clear modal fields for new data
        clearFields();

        //skeleton loading
        $('.skeleton').addClass('skeleton-text');
        $('.skeleton-header').addClass('skeleton-title');


        const CSRF_TOKEN = "<?= $this->request->getAttribute('csrfToken')?>";

        //document.getElementById('newChecklistForm').setAttribute('action', document.getElementById('newChecklistForm').getAttribute('action')+"/"+id);
        document.getElementById('editCardTitleForm').setAttribute('action', "<?= $this->Url->build(['controller' => 'Cards', 'action' => 'edit']) ?>/"+id);
        document.getElementById('editDescriptionForm').setAttribute('action', "<?= $this->Url->build(['controller' => 'Cards', 'action' => 'edit']) ?>/"+id);
        document.getElementById('newChecklistForm').setAttribute('action', "<?= $this->Url->build(['controller' => 'Checklists', 'action' => 'add']) ?>/"+id);

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

                    //remove skeleton loading
                    $('.skeleton-text').removeClass('skeleton-text');
                    $('.skeleton-title').removeClass('skeleton-title');
                    
                    const checklists = result['checklists'];
                    //fill fields
                    document.getElementById('cardTitle').innerHTML = result['name'];
                    document.getElementById('cardTitleInput').value = result['name'];
                    
                    
                    if (result['description'] == null || result['description'] == "") {
                        document.getElementById('description').innerHTML = "Add a description...";
                    } else {
                        document.getElementById('description').innerHTML = result['description'];
                        document.getElementById('descriptionInput').innerHTML = result['description'];
                    }
                    
                    
                    
                    //checklists
                    for (let i = 0; i < checklists.length; i++) {
                        
                        let checklist = document.createElement("div");
                        checklist.setAttribute('id','checklist-'+i);
                        checklist.innerHTML = checklists[i]['name'];
                        let checklist_id = checklists[i]['id'];
                        document.getElementById('checklistList').appendChild(checklist);

                        //form element, append to checklist UL
                        //form will create new checklist items
                        let checklistItemForm = document.createElement("form");
                        checklistItemForm.setAttribute('id', 'form-'+i);
                        checklistItemForm.setAttribute('method', 'post');
                        checklistItemForm.setAttribute('action', '<?= $this->Url->build(['controller' => 'ChecklistItems', 'action' => 'add']) ?>/'+checklist_id);
                        document.getElementById('checklist-'+i).appendChild(checklistItemForm);

                        //csrf
                        let csrf_input = document.createElement("input");
                        csrf_input.setAttribute('style','display:none');
                        csrf_input.setAttribute('name','_csrfToken');
                        csrf_input.setAttribute('value', CSRF_TOKEN);
                        checklistItemForm.appendChild(csrf_input);

                        let input = document.createElement("INPUT");
                        let submit = document.createElement("BUTTON");
                        input.setAttribute('name', 'name');
                        input.setAttribute('placeholder', 'Add an item');
                        submit.setAttribute('type','submit');
                        submit.setAttribute('class','btn btn-sm btn-primary');
                        submit.innerHTML = 'Add';
                        document.getElementById('form-'+i).appendChild(input);
                        document.getElementById('form-'+i).appendChild(submit);


                        //document.getElementById('checklist-'+i).appendChild(submit);

                        
                        

                        //checklist items
                        for (let j = 0; j < checklists[i]['checklist_items'].length; j++) {
                            let checkItem = document.createElement("input");
                            let checkItemLabel = document.createElement("label");
                            checkItem.setAttribute('type','checkbox');
                            checkItem.setAttribute('class','form-check-input');
                            checkItemLabel.innerHTML = checklists[i]['checklist_items'][j]['name'];
                            document.getElementById('checklist-'+i).appendChild(checkItem); 
                            document.getElementById('checklist-'+i).appendChild(checkItemLabel); 

                            
                        }
                    }
                    //document.getElementById('checklistTitle').innerHTML = checklists[0]['name'];
                    
                
                }
            }
        });
    }

    function clearFields() {
        document.getElementById('cardTitle').innerHTML = '';
        document.getElementById('cardTitleInput').innerHTML = '';
        document.getElementById('description').innerHTML = '';
        document.getElementById('descriptionInput').innerHTML = '';
        
        while (document.getElementById('checklistList').firstChild) {
            document.getElementById('checklistList').removeChild(document.getElementById('checklistList').firstChild);
        }

        //hide opened input boxes
        $("#editDescriptionForm").hide();
        $("#description").show();
        $("#newChecklistForm").hide();
        $("#newChecklist").show();
        $("#editCardTitleForm").hide();
        $("#cardTitle").show();


        //checklist add form
        // newChecklistForm = document.getElementById('newChecklistForm').getAttribute('action');
        // document.getElementById('newChecklistForm').setAttribute('action', newChecklistForm.slice(0, -1))

        // while (document.getElementById('checklistItems').firstChild) {
        //     document.getElementById('checklistItems').removeChild(document.getElementById('checklistItems').firstChild);
        // }
    }
    

</script>


