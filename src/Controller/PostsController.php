<?php
namespace Blog\Controller;

use Blog\Controller\AppController;

/**
 * Posts Controller
 *
 * @property \Blog\Model\Table\PostsTable $Posts
 */
class PostsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $tags = $this->request->getQuery('tags');
        
        if (!is_null($tags)) :
            $query = $this->Posts->find()
                ->contain([
                    'Media',
                    'Users',
                    'Tags'])
                ->matching('Tags', function ($q) use ($tags) {
                    return $q->where(['Tags.label LIKE "'. $tags[0] .'"']);
                })
                ->order('Posts.created DESC');
        else:
            $query = $this->Posts->find()
                ->contain(['Tags','Users','Media'])
                ->order('Posts.created DESC');
        endif;
				$tags = $this->Posts->Tags->find()->select(['label'])->distinct(['label'])->all();
        $posts = $this->paginate($query);

        $this->set(compact('posts','tags'));
        $this->set('_serialize', ['posts','tags']);
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => ['Users','Tags','Media']
        ]);

        $this->set('post', $post);
        $this->set('_serialize', ['post']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        } else {
#          $post->id = $this->Posts->getDraftId($this->Posts);
        }
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $this->set(compact('post', 'users'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => ['Tags','Media','Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
				$users = $this->Posts->Users->find('list', ['limit' => 200,'keyField'=>'id','valueField'=>'username']);
        // Manage Tags
        $delimiter = ','; // same as delimiter at TagBehavior
        $tags = [];
        $alltags = $post->tags;
        foreach ($alltags as $tag):
          $tags[] = $tag->label;
        endforeach;
        $post->tags = implode($delimiter, $tags);
        $this->set(compact('post', 'users'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id, [
            'contain' => ['Tags','Media','Users']
        ]);
        if ($this->Posts->delete($post)) {
            foreach($post['media'] as $media) {;
                $this->Posts->Media->delete($media);
            }
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
