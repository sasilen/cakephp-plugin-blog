<?php
namespace Blog\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Posts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentPosts
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $ChildPosts
 * @property \Cake\ORM\Association\BelongsToMany $Categories
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

        $this->setTable('posts');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ParentPosts', [
            'className' => 'Blog.Posts',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Blog.Users'
        ]);
        $this->hasMany('ChildPosts', [
            'className' => 'Blog.Posts',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsToMany('Categories', [
            'foreignKey' => 'post_id',
            'targetForeignKey' => 'category_id',
            'joinTable' => 'categories_posts',
            'className' => 'Blog.Categories'
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
            ->dateTime('startdate')
            ->allowEmpty('startdate');

        $validator
            ->dateTime('enddate')
            ->allowEmpty('enddate');

        $validator
            ->allowEmpty('link');

        $validator
            ->boolean('auth')
            ->allowEmpty('auth');

        $validator
            ->boolean('darken')
            ->allowEmpty('darken');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentPosts'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
