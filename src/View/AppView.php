<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\View;

use Cake\View\View;

/**
 * Application View
 *
 * Your application’s default view class
 *
 * @link https://book.cakephp.org/3.0/en/views.html#the-app-view
 */
class AppView extends View
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize(): void
    {

        // $this->request->addDetector('admin', ['param' => 'prefix', 'value' => 'admin']);


        if (!empty($this->request->getParam('prefix')) && $this->request->getParam('prefix') == 'Admin') {
            $this->initializeAdmin();
        } else {
            $this->initializeDefault();
        }
        if (is_null($this->request->getParam('prefix'))) {
            $this->loadHelper('Time', ['outputTimezone' => 'America/Argentina/Buenos_Aires']);
        }
        if (!empty($this->viewVars['title_for_layout'])) {
            $this->assign('title', $this->viewVars['title_for_layout']);
        }
    }
    private function initializeAdmin()
    {
        $this->loadHelper('Form', [
            'templates' => 'admin_app_form',
        ]);
        $this->loadHelper('Time', ['outputTimezone' => 'America/Argentina/Buenos_Aires']);
    }
    private function initializeDefault()
    {
        $this->loadHelper('Form', [
            'templates' => 'app_form',
        ]);
        $this->loadHelper('Ligrila.Email');
    }
}
