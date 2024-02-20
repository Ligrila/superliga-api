<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property string $id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property $picture
 * @property int $picture_dir
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Answer[] $answers
 * @property \App\Model\Entity\Life $life
 * @property \App\Model\Entity\Point $point
 * @property \App\Model\Entity\ProcessedAnswer[] $processed_answers
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEmptyEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
    ];

    protected $_virtual = [
        'avatar'
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _getAvatar()
    {
        $file = \Cake\Routing\Router::url('/img/default_avatar.jpg', true);
        if (!empty($this->_fields['picture'])) {
            return $this->_fields['picture'];
        }

        return $file;
    }
}
