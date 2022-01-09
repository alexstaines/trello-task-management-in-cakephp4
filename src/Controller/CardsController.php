<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\Time;
use Cake\I18n\Date;

/**
 * Cards Controller
 *
 * @property \App\Model\Table\CardsTable $Cards
 * @method \App\Model\Entity\Card[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CardsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {


        //ajax for card-onclick
        if ($this->request->is('ajax')) {
            
            $this->autoRender = false;

            if ($this->request->getData()['action'] == 'get') {
                $id = intval($this->request->getData()['id']);

                $card = $this->Cards->get($id, ['contain' => ['Checklists.ChecklistItems']]);

                // $task->due_date = $task->due_date->format('d/m/Y');
                // $task->created_date = $task->created_date->format('d/m/Y h:ia');
                // $task->modified_date = $task->modified_date->format('d/m/Y h:ia');
                $card = json_encode($card);

                echo $card;

            }
            
        }



        $this->paginate = [
            'contain' => ['Lanes'],
        ];
        $cards = $this->paginate($this->Cards);

        $this->set(compact('cards'));
    }

    /**
     * View method
     *
     * @param string|null $id Card id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $card = $this->Cards->get($id, [
            'contain' => ['Lanes', 'Checklists'],
        ]);

        $this->set(compact('card'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $last_pos = $this->Cards->find('all', ['conditions' => ['lane_id' => $id], 'order' => ['position' => 'DESC'], 'limit'=>1])->first();

        //check if no cards, or existing cards have no position assigned.
        if (is_null($last_pos) || is_null($last_pos->position)) {
            $last_pos = -1;
        } else {
            $last_pos = $last_pos->position;
        }


        $card = $this->Cards->newEmptyEntity();
        if ($this->request->is('post')) {
            $card = $this->Cards->patchEntity($card, $this->request->getData());

            $card->name = 'New Card';
            $card->created = Time::now();
            $card->modified = Time::now();

            $card->position = $last_pos + 1;
            $card->lane_id = $id;
            if ($this->Cards->save($card)) {
                $this->Flash->success(__('The card has been saved.'));

                return $this->redirect(['controller' => 'Lanes', 'action' => 'index']);
            }
            $this->Flash->error(__('The card could not be saved. Please, try again.'));
        }
        $lanes = $this->Cards->Lanes->find('list', ['limit' => 200])->all();
        $this->set(compact('card', 'lanes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Card id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $card = $this->Cards->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $card = $this->Cards->patchEntity($card, $this->request->getData());

            $card->modified = Time::now();

            if ($this->Cards->save($card)) {
                $this->Flash->success(__('The card has been saved.'));

                return $this->redirect(['controller' => 'Lanes', 'action' => 'index']);
            }
            $this->Flash->error(__('The card could not be saved. Please, try again.'));
        }
        $lanes = $this->Cards->Lanes->find('list', ['limit' => 200])->all();
        $this->set(compact('card', 'lanes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Card id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $card = $this->Cards->get($id);
        if ($this->Cards->delete($card)) {
            $this->Flash->success(__('The card has been deleted.'));
        } else {
            $this->Flash->error(__('The card could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
