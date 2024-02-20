<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LivePack Entity
 *
 * @property int $id
 * @property string $name
 * @property int $lives
 * @property float $price
 * @property string $currency_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Currency $currency
 */
class LivePack extends Entity
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
        'name' => true,
        'lives' => true,
        'price' => true,
        'currency_id' => true,
        'created' => true,
        'modified' => true,
        'currency' => true
    ];
}
