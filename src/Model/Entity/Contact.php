<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contact Entity
 *
 * @property int $id
 * @property string|null $user_id
 * @property int|null $contact_topic_id
 * @property string|null $body
 * @property \Cake\I18n\FrozenTime|null $created
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ContactTopic $contact_topic
 */
class Contact extends Entity
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
        'contact_topic_id' => true,
        'body' => true,
        'created' => true,
        'user' => true,
        'contact_topic' => true
    ];
}
