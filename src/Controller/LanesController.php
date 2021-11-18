<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lanes Controller
 *
 * @property \App\Model\Table\LanesTable $Lanes
 * @method \App\Model\Entity\Lane[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LanesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $lanes = $this->paginate($this->Lanes);

        $this->set(compact('lanes'));
    }

    /**
     * View method
     *
     * @param string|null $id Lane id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lane = $this->Lanes->get($id, [
            'contain' => ['Cards'],
        ]);

        $this->set(compact('lane'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lane = $this->Lanes->newEmptyEntity();
        if ($this->request->is('post')) {
            $lane = $this->Lanes->patchEntity($lane, $this->request->getData());
            if ($this->Lanes->save($lane)) {
                $this->Flash->success(__('The lane has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lane could not be saved. Please, try again.'));
        }
        $this->set(compact('lane'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lane id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lane = $this->Lanes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lane = $this->Lanes->patchEntity($lane, $this->request->getData());
            if ($this->Lanes->save($lane)) {
                $this->Flash->success(__('The lane has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lane could not be saved. Please, try again.'));
        }
        $this->set(compact('lane'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lane id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lane = $this->Lanes->get($id);
        if ($this->Lanes->delete($lane)) {
            $this->Flash->success(__('The lane has been deleted.'));
        } else {
            $this->Flash->error(__('The lane could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
