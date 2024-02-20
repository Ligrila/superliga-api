<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Point Entity
 *
 * @property string $user_id
 * @property float $points
 *
 * @property \App\Model\Entity\User $user
 */
class Point extends Entity
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
