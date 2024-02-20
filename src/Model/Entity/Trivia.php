<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Trivia Entity
 *
 * @property string $id
 * @property int $local_club_id
 * @property int $visit_club_id
 * @property \Cake\I18n\FrozenTime $start_datetime
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\LocalClub $local_club
 * @property \App\Model\Entity\VisitClub $visit_club
 * @property \App\Model\Entity\ProcessedAnswer[] $processed_answers
 * @property \App\Model\Entity\Question[] $questions
 */
class Trivia extends Entity
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
    public function _getFullTitle(){
        $title = $visitTeam = $localTeam = null;
        //debug($this->_properties);
        if(!empty($this->_fields['local_team'])){
            $localTeam=$this->_fields['local_team']->name;
        }
        if(!empty($this->_fields['visit_team'])){
            $visitTeam=$this->_fields['visit_team']->name;
        }
        if(!empty($this->_fields['title1'])){
            $title=$this->_fields['title1'];
        }
        if(!empty($this->_fields['title2'])){
            $title .= " " . $this->_fields['title2'];
        }


        $datetime = $this->_fields['start_datetime'];
        if($this->_fields['local_team_id']==0&&$this->_fields['visit_team_id']==0){
            return "$datetime - Trivia programada ($title)";
        }

        return "$datetime - $localTeam VS $visitTeam";
    }
    public function _getStatus(){

        if(!$this->_fields['enabled']){
            return 'No se juega';
        }
        $finished = $this->_fields['finished'];
        $in_progress = $this->_fields['in_progress'];
        if($finished){
            return 'Finalizada';
        }
        $startDatetime =  $this->_fields['start_datetime'];
        $referenceTime = \Cake\I18n\FrozenTime::now("-15 minutes");
        if(!$in_progress &&$startDatetime<$referenceTime){
            return 'Caducada';
        }


        return $in_progress ? 'Jugando ahora!' : 'Esperando' ;
    }

}
