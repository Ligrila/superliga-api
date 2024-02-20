<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InfiniteLife Entity
 *
 * @property int $id
 * @property string $user_id
 * @property string $order_id
 * @property \Cake\I18n\FrozenTime $until
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Order $order
 */
class InfiniteLife extends Entity
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
        'order_id' => true,
        'until' => true,
        'created' => true,
        'user' => true,
        'order' => true
    ];
}
