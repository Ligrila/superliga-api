<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WrongAnswer Entity
 *
 * @property string $id
 * @property string $user_id
 * @property string $question_id
 * @property string $trivia_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Question $question
 * @property \App\Model\Entity\Trivia $trivia
 */
class WrongAnswer extends Entity
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
        'id' => true,
        'user_id' => true,
        'question_id' => true,
        'trivia_id' => true,
        'user' => true,
        'question' => true,
        'trivia' => true
    ];
}
