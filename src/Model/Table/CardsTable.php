<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cards Model
 *
 * @property \App\Model\Table\LanesTable&\Cake\ORM\Association\BelongsTo $Lanes
 * @property \App\Model\Table\ChecklistsTable&\Cake\ORM\Association\HasMany $Checklists
 *
 * @method \App\Model\Entity\Card newEmptyEntity()
 * @method \App\Model\Entity\Card newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Card[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Card get($primaryKey, $options = [])
 * @method \App\Model\Entity\Card findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Card patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Card[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Card|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Card saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Card[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Card[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Card[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Card[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CardsTable extends Table
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

        $this->setTable('cards');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Lanes', [
            'foreignKey' => 'lane_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Checklists', [
            'foreignKey' => 'card_id',
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
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('position')
            ->allowEmptyString('position');

        $validator
            ->scalar('name')
            ->maxLength('name', 64)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 16777215)
            ->allowEmptyString('description');

        $validator
            ->dateTime('due_date')
            ->allowEmptyDateTime('due_date');

        $validator
            ->boolean('archived')
            ->allowEmptyString('archived');

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
        $rules->add($rules->existsIn('lane_id', 'Lanes'), ['errorField' => 'lane_id']);

        return $rules;
    }
}
