<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Question Entity
 *
 * @property string $id
 * @property string $trivia_id
 * @property string $question
 * @property string $option_1
 * @property string $option_2
 * @property string $option_3
 * @property string $correct_option
 * @property bool $finished
 * @property \Cake\I18n\FrozenTime $finished_datetime
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Trivia $trivia
 * @property \App\Model\Entity\Answer[] $answers
 */
class Question extends Entity
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
        '*' => true
    ];
}
