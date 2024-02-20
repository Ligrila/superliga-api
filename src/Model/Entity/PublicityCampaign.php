<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PublicityCampaign Entity
 *
 * @property int $id
 * @property string $model
 * @property string|null $trivia_id
 * @property int $banner_id
 * @property int|null $model_value
 * @property string|null $model_used_value
 * @property bool|null $enabled
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Trivia $trivia
 * @property \App\Model\Entity\Banner $banner
 */
class PublicityCampaign extends Entity
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

    protected $_virtual = [
        'navigate'
    ];

    private $modelTypes = [
        'questions' => 'Preguntas',
        'trivias' => 'Trivias'
    ];

    protected function _getModelTypes()
    {
        return $this->modelTypes;
    }

    protected function _getNavigate(){
        $hasAction = !empty($this->_fields['action']);
        $action = $this->_fields['action'];
        $actionTarget = $this->_fields['action_target'];
        $actionTargetUrl = $this->_fields['action_target_url'];
        $dataParam = $action== 'link' ? "{\"navigate\":\"InAppBrowser\",\"params\":{\"url\":\"$actionTargetUrl\"}}" : "{\"navigate\":\"$actionTarget\"}";
        return json_decode($dataParam,true);
    }
}
