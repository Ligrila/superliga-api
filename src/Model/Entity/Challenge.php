<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Challenge Entity
 *
 * @property string $id
 * @property string $championship1_id
 * @property string $championship2_id
 * @property string $user1_id
 * @property string $user2_id
 * @property \Cake\I18n\FrozenDate $until
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Championship1 $championship1
 * @property \App\Model\Entity\Championship2 $championship2
 * @property \App\Model\Entity\User1 $user1
 * @property \App\Model\Entity\User2 $user2
 */
class Challenge extends Entity
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
