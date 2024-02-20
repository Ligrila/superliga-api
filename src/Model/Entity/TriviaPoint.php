<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TriviaPoint Entity
 *
 * @property string $trivia_id
 * @property string $user_id
 * @property float $points
 *
 * @property \App\Model\Entity\Trivia $trivia
 * @property \App\Model\Entity\User $user
 */
class TriviaPoint extends Entity
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
        'trivia_id' => true,
        'user_id' => true,
        'points' => true,
        'trivia' => true,
        'user' => true
    ];
}
