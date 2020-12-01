<?php
declare(strict_types=1);

namespace Sasilen\Blog\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\EventInterface;
use ArrayObject;

/**
 * Posts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \Blog\Model\Entity\Post get($primaryKey, $options = [])
 * @method \Blog\Model\Entity\Post newEntity($data = null, array $options = [])
 * @method \Blog\Model\Entity\Post[] newEntities(array $data, array $options = [])
 * @method \Blog\Model\Entity\Post|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Blog\Model\Entity\Post patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Blog\Model\Entity\Post[] patchEntities($entities, array $data, array $options = [])
 * @method \Blog\Model\Entity\Post findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PostsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->addBehavior('Muffin/Tags.Tag');
        $this->hasMany('Medias',['foreignKey' => 'ref_id']);//->setConditions(['Medias.ref' => 'Blog.Posts']);

        $this->setTable('posts');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT',
            'className' => 'Blog.Users'
        ]);
    }
    /**
    * Change the multiple upload array of UploadedFile into something which the Cake marshaller understands
	 *
	 * @param \Cake\Event\Event $event
	 * @param \ArrayObject $data
	 * @param \ArrayObject $options
	 */
	public function beforeMarshal(EventInterface $event, ArrayObject $data, ArrayObject $options)
	{
		$newUploads = [];
		if (isset($data['medias'])) {
			foreach ($data['medias'] as $upload) {
				$newUploads[] = ['file' => $upload];
			}
		}
        $data['medias'] = $newUploads;
	}
    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
    $validator
        ->integer('id')
        ->notEmptyString('id');

/*    $validator
        ->scalar('slug')
        ->maxLength('slug', 255)
        ->requirePresence('slug', 'create')
        ->notEmptyString('slug');
 */
    $validator
        ->scalar('name')
        ->maxLength('name', 255)
        ->requirePresence('name', 'create')
        ->notEmptyString('name');

    $validator
        ->scalar('summary')
        ->maxLength('summary', 16777215)
        ->requirePresence('summary', 'create')
        ->notEmptyString('summary');

    $validator
        ->scalar('body')
        ->maxLength('body', 16777215)
        ->requirePresence('body', 'create')
        ->notEmptyString('body');

    $validator
        ->boolean('online')
        ->allowEmptyString('online');

    $validator
        ->boolean('auth')
        ->allowEmptyString('auth');

    $validator
        ->integer('tag_count')
        ->allowEmptyString('tag_count');

    return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        return $rules;
    }
}
