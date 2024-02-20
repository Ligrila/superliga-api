<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Championship Entity
 *
 * @property string $id
 * @property string $name
 * @property string $user_id
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ChampionshipUser[] $championship_users
 */
class Championship extends Entity
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

    protected function _getAvatar()
    {
        $file = null;
        if (!empty($this->_fields['picture'])) {
            return $this->_fields['picture'];
        }

        return $file;
    }
}
