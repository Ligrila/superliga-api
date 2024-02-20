<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Answer Entity
 *
 * @property string $id
 * @property int $user_id
 * @property string $question_id
 * @property string $selected_option
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Question $question
 * @property \App\Model\Entity\ProcessedAnswer[] $processed_answers
 */
class Answer extends Entity
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
