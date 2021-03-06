<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\ChecklistItem;

/**
 * ChecklistItems Controller
 *
 * @property \App\Model\Table\ChecklistItemsTable $ChecklistItems
 * @method \App\Model\Entity\ChecklistItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChecklistItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Checklists'],
        ];
        $checklistItems = $this->paginate($this->ChecklistItems);

        $this->set(compact('checklistItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Checklist Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $checklistItem = $this->ChecklistItems->get($id, [
            'contain' => ['Checklists'],
        ]);

        $this->set(compact('checklistItem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $last_pos = $this->ChecklistItems->find('all', ['conditions' => ['checklist_id' => $id], 'order' => ['position' => 'DESC'], 'limit'=>1])->first();

        //check if no cards, or existing cards have no position assigned.
        if (is_null($last_pos) || is_null($last_pos->position)) {
            $last_pos = -1;
        } else {
            $last_pos = $last_pos->position;
        }

        $checklistItem = $this->ChecklistItems->newEmptyEntity();
        if ($this->request->is('post')) {
            $checklistItem = $this->ChecklistItems->patchEntity($checklistItem, $this->request->getData());

            $checklistItem->checklist_id = $id;

            $checklistItem->position = $last_pos + 1;
            
            if ($this->ChecklistItems->save($checklistItem)) {
                $this->Flash->success(__('The checklist item has been saved.'));

                return $this->redirect(['controller' => 'Lanes', 'action' => 'index']);
            }
            $this->Flash->error(__('The checklist item could not be saved. Please, try again.'));
        }
        // $checklists = $this->ChecklistItems->Checklists->find('list', ['limit' => 200])->all();
        // $this->set(compact('checklistItem', 'checklists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Checklist Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $checklistItem = $this->ChecklistItems->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $checklistItem = $this->ChecklistItems->patchEntity($checklistItem, $this->request->getData());
            if ($this->ChecklistItems->save($checklistItem)) {
                $this->Flash->success(__('The checklist item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The checklist item could not be saved. Please, try again.'));
        }
        $checklists = $this->ChecklistItems->Checklists->find('list', ['limit' => 200])->all();
        $this->set(compact('checklistItem', 'checklists'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Checklist Item id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $checklistItem = $this->ChecklistItems->get($id);
        if ($this->ChecklistItems->delete($checklistItem)) {
            $this->Flash->success(__('The checklist item has been deleted.'));
        } else {
            $this->Flash->error(__('The checklist item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
