<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Post Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $updated
 * @property int $user_id
 * @property string $title
 * @property string $content
 * @property string $tags
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Comment $comment
 */
class Post extends Entity
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
        'created' => true,
        'updated' => true,
        'user_id' => true,
        'title' => true,
        'content' => true,
        'tags' => true,
        'user' => true,
        'comment' => true
    ];


    public function _setTitle($title){
        return strip_tags($title);
    }

    public function _setTags($tags){
        return strip_tags($tags);
    }
}
