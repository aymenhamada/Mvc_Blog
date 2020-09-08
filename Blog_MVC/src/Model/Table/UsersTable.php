<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('username')
            ->maxLength('username', 20, 'A valid username is less than 20 characters')
            ->requirePresence('username', 'create')
            ->notEmpty('username', 'Please put a username');

        $validator
            ->scalar('password')
            ->maxLength('password', 20, 'A valid password is less than 20characters')
            ->requirePresence('password', 'create')
            ->notEmpty('password', 'Please put a password');


        $validator
            ->scalar('name')
            ->maxLength('name', 20, 'A valid name is less than 20 characters')
            ->requirePresence('name', 'create')
            ->notEmpty('username', 'Please put your name');


        $validator
            ->scalar('lastname')
            ->maxLength('lastname', 20, 'A valid last name is less than 20 characters')
            ->requirePresence('lastname', 'create')
            ->notEmpty('username', 'Please put your last name');


        $validator
            ->date('birthdate')
            ->requirePresence('birthdate', 'create')
            ->notEmpty('username', 'Please put your birthdate');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('username', 'Please put a email');


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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
