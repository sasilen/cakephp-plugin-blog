<?php
declare(strict_types=1);

namespace Sasilen\Blog\Controller;

use App\Controller\AppController;
use Cake\Http\Response;
use Zend\Diactoros\Stream;
use Cake\Utility\Hash;


/**
 * Posts Controller
 * 
 *
 * @method \Blog\Model\Entity\Result[]|\Cake\Datasource\BlogSetInterface paginate($object = null, array $settings = [])
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
        $where = ['Posts.online'=>1];
        if ($this->request->getAttribute('identity')->is_superuser) $where = [1=>1];
        if (!is_null($tags)) :
            $query = $this->Posts->find()
                ->contain([
                    'Medias',
                    'Users',
                    'Tags'])
                ->matching('Tags', function ($q) use ($tags) {
                    return $q->where(['Tags.label LIKE "'. $tags .'"']);
                })
                ->order('Posts.created DESC')
                ->where($where);
        else:
            $query = $this->Posts->find()
                ->contain(['Tags','Users','Medias'])
                ->order('Posts.created DESC')
                ->where($where);
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
            'contain' => ['Users','Tags','Medias']
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
				$users = $this->Posts->Users->find('list', ['limit' => 200,'keyField'=>'id','valueField'=>'username']);

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
            'contain' => ['Tags','Medias','Users']
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
    public function display ($post_id,$media_id=0,$type='thumbs') {
        $post = $this->Posts->get($post_id, [
            'contain' => ['Tags','Medias','Users']
        ]);
        $filename = Hash::extract($post['medias'], '{n}[id='.$media_id.'].file')[0];
        $ref= Hash::extract($post['medias'], '{n}[id='.$media_id.'].ref')[0];
	    $refc = str_replace(".", "", substr($ref, strpos($ref, ".")));
      	$path = ROOT.'/../img/'.$refc.'/'.$type.'/'.basename($filename);
        $stream = new Stream($path, 'rb');
        $this->response = $this->response->withType('jpeg');
        $response = $this->response->withBody($stream);
        return $response;
    }
}
