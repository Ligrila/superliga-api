<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Node Entity
 *
 * @property int $id
 * @property string|null $slug
 * @property string|null $title
 * @property string|null $body
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class Node extends Entity
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
        'slug' => true,
        'title' => true,
        'body' => true,
        'created' => true,
        'modified' => true
    ];
}
