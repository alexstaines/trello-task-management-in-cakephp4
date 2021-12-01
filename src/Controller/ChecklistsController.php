<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Checklists Controller
 *
 * @property \App\Model\Table\ChecklistsTable $Checklists
 * @method \App\Model\Entity\Checklist[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChecklistsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Cards'],
        ];
        $checklists = $this->paginate($this->Checklists);

        $this->set(compact('checklists'));
    }

    /**
     * View method
     *
     * @param string|null $id Checklist id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $checklist = $this->Checklists->get($id, [
            'contain' => ['Cards', 'ChecklistItems'],
        ]);

        $this->set(compact('checklist'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $checklist = $this->Checklists->newEmptyEntity();
        if ($this->request->is('post')) {
            $checklist = $this->Checklists->patchEntity($checklist, $this->request->getData());

            $checklist->card_id = $id;
            if ($this->Checklists->save($checklist)) {
                $this->Flash->success(__('The checklist has been saved.'));

                return $this->redirect(['controller' => 'Lanes', 'action' => 'index']);
            }
            $this->Flash->error(__('The checklist could not be saved. Please, try again.'));
        }
        // $cards = $this->Checklists->Cards->find('list', ['limit' => 200])->all();
        // $this->set(compact('checklist', 'cards'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Checklist id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $checklist = $this->Checklists->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $checklist = $this->Checklists->patchEntity($checklist, $this->request->getData());
            if ($this->Checklists->save($checklist)) {
                $this->Flash->success(__('The checklist has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The checklist could not be saved. Please, try again.'));
        }
        $cards = $this->Checklists->Cards->find('list', ['limit' => 200])->all();
        $this->set(compact('checklist', 'cards'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Checklist id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $checklist = $this->Checklists->get($id);
        if ($this->Checklists->delete($checklist)) {
            $this->Flash->success(__('The checklist has been deleted.'));
        } else {
            $this->Flash->error(__('The checklist could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
