<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Personnage Controller
 *
 * @property \App\Model\Table\PersonnageTable $Personnage
 *
 * @method \App\Model\Entity\Personnage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PersonnageController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $personnage = $this->paginate($this->Personnage);

        $this->set(compact('personnage'));
    }

    /**
     * View method
     *
     * @param string|null $id Personnage id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $personnage = $this->Personnage->get($id, [
            'contain' => []
        ]);

        $this->set('personnage', $personnage);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $personnage = $this->Personnage->newEntity();
        if ($this->request->is('post')) {
            $personnage = $this->Personnage->patchEntity($personnage, $this->request->getData());
            $personnage->user_id = $this->Auth->user('id');
            if ($this->Personnage->save($personnage)) {
                $this->Flash->success(__('The personnage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The personnage could not be saved. Please, try again.'));
        }
        $this->set(compact('personnage'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Personnage id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $personnage = $this->Personnage->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $personnage = $this->Personnage->patchEntity($personnage, $this->request->getData());
            if ($this->Personnage->save($personnage)) {
                $this->Flash->success(__('The personnage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The personnage could not be saved. Please, try again.'));
        }
        $this->set(compact('personnage'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Personnage id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $personnage = $this->Personnage->get($id);
        if ($this->Personnage->delete($personnage)) {
            $this->Flash->success(__('The personnage has been deleted.'));
        } else {
            $this->Flash->error(__('The personnage could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function isAuthorized($user)
{
    // All registered users can add articles
    // Prior to 3.4.0 $this->request->param('action') was used.
    if ($this->request->getParam('action') === 'add') {
        return true;
    }

    // The owner of an article can edit and delete it
    // Prior to 3.4.0 $this->request->param('action') was used.
    if (in_array($this->request->getParam('action'), ['edit', 'delete'])) {
        // Prior to 3.4.0 $this->request->params('pass.0')
        $personnageId = (int)$this->request->getParam('pass.0');
        if ($this->Personnage->isOwnedBy($personnageId, $user['id'])) {
            return true;
        }
    }

    return parent::isAuthorized($user);
}
}
