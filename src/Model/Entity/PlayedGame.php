<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PlayedGame Entity
 *
 * @property string $user_id
 * @property int $count
 *
 * @property \App\Model\Entity\User $user
 */
class PlayedGame extends Entity
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
        'user_id' => true,
        'count' => true,
        'user' => true
    ];
}
