<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $lastname
 * @property \Cake\I18n\FrozenDate $birthdate
 * @property string $email
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'username' => true,
        'password' => true,
        'name' => true,
        'lastname' => true,
        'birthdate' => true,
        'email' => true,
        'role' => true,
        'active' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    public function _setPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function _setLastname($lastname){
        return strip_tags($lastname);
    }

    public function _setEmail($email){
        return strip_tags($email);
    }

    public function _setName($name){
        return strip_tags($name);
    }

    public function _setUsername($username){
        return strip_tags($username);
    }

}
