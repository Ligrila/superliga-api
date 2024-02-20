<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ChampionshipUser Entity
 *
 * @property string $id
 * @property string $championship_id
 * @property string $user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Championship $championship
 * @property \App\Model\Entity\User $user
 */
class ChampionshipUser extends Entity
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
}
