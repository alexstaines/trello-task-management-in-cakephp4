<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Checklists Model
 *
 * @property \App\Model\Table\CardsTable&\Cake\ORM\Association\BelongsTo $Cards
 * @property \App\Model\Table\ChecklistItemsTable&\Cake\ORM\Association\HasMany $ChecklistItems
 *
 * @method \App\Model\Entity\Checklist newEmptyEntity()
 * @method \App\Model\Entity\Checklist newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Checklist[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Checklist get($primaryKey, $options = [])
 * @method \App\Model\Entity\Checklist findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Checklist patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Checklist[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Checklist|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Checklist saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Checklist[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Checklist[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Checklist[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Checklist[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ChecklistsTable extends Table
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

        $this->setTable('checklists');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Cards', [
            'foreignKey' => 'card_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('ChecklistItems', [
            'foreignKey' => 'checklist_id',
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
        $rules->add($rules->existsIn('card_id', 'Cards'), ['errorField' => 'card_id']);

        return $rules;
    }
}
