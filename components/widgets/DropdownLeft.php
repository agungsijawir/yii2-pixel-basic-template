<?php

namespace app\components\widgets;

use yii\bootstrap\Dropdown;
use yii\bootstrap\Html;

/**
 * Class DropdownLeft
 *
 * @package app\components\widgets
 */
class DropdownLeft extends Dropdown
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->submenuOptions === null) {
            // copying of [[options]] kept for BC
            $this->submenuOptions = $this->options;
            unset($this->submenuOptions['id']);
        }
        parent::init();
        Html::removeCssClass($this->options, ['widget' => 'dropdown-menu']);
    }
}