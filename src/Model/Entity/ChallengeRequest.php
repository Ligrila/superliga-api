<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ChallengeRequest Entity
 *
 * @property string $id
 * @property string $championship_id
 * @property string $user_id
 * @property string $challenge_championship_id
 * @property bool $notified
 * @property string $message
 * @property bool $acepted
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modifed
 *
 * @property \App\Model\Entity\Championship $championship
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ChallengeChampionship $challenge_championship
 */
class ChallengeRequest extends Entity
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
