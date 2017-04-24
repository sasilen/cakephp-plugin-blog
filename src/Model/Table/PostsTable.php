<?php
namespace Blog\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

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
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->addBehavior('Muffin/Tags.Tag');
        $this->addBehavior('Romano83/Cakephp3Draft.Draft');
        $this->addBehavior('Media.Media', [
          'path' => 'img/upload/%y/%m/%f',  // default upload path relative to webroot folder (see below for path parameters)
          'extensions' => ['jpg', 'png'],   // array of authorized extensions (lowercase)
          'limit' => 0,           // limit number of upload file. Default: 0 (no limit)
          'max_width' => 0,         // maximum authorized width for uploaded pictures. Default: 0 (no limitation) 
          'max_height' => 0,          // maximum authorized height for uploaded pictures. Default: 0 (no limitation)
          'size' => 0             // maximum autorized size for uploaded pictures (in kb). Default: 0 (no limitation)
          ]
        );

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
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('summary', 'create')
            ->notEmpty('summary');

        $validator
            ->requirePresence('body', 'create')
            ->notEmpty('body');

        $validator
            ->boolean('published')
            ->allowEmpty('published');

        $validator
            ->boolean('auth')
            ->allowEmpty('auth');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
