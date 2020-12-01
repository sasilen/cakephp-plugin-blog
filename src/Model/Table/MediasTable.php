<?php
declare(strict_types=1);

namespace Sasilen\Blog\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Medias Model
 *
 * @property \Blog\Model\Table\RevesTable&\Cake\ORM\Association\BelongsTo $Reves
 *
 * @method \Blog\Model\Entity\Media newEmptyEntity()
 * @method \Blog\Model\Entity\Media newEntity(array $data, array $options = [])
 * @method \Blog\Model\Entity\Media[] newEntities(array $data, array $options = [])
 * @method \Blog\Model\Entity\Media get($primaryKey, $options = [])
 * @method \Blog\Model\Entity\Media findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Blog\Model\Entity\Media patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Blog\Model\Entity\Media[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Blog\Model\Entity\Media|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Blog\Model\Entity\Media saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Blog\Model\Entity\Media[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Blog\Model\Entity\Media[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Blog\Model\Entity\Media[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Blog\Model\Entity\Media[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class MediasTable extends Table
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

        $this->setTable('medias');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
    	$this->addBehavior('Proffer.Proffer', [
            'name' => [
                'root' => WWW_ROOT,
    	        'dir' => 'file',
	            ]
    	    ]
        ]);
        $this->belongsTo('Posts', [
            'foreignKey' => 'ref_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
    /*    $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('ref')
            ->maxLength('ref', 60)
            ->requirePresence('ref', 'create')
            ->notEmptyString('ref');

        $validator
            ->scalar('file')
            ->maxLength('file', 255)
            ->requirePresence('file', 'create')
            ->allowEmptyString('file');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        $validator
            ->integer('position')
            ->requirePresence('position', 'create')
            ->notEmptyString('position');

        $validator
            ->scalar('caption')
            ->allowEmptyString('caption');

    return $validator;*/
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
        $rules->add($rules->existsIn(['post_id'], 'Blog'), ['errorField' => 'post_id']);

        return $rules;
    }
}
