<?php

namespace app\components\widgets;
use yii\base\InvalidConfigException;
use yii\bootstrap\Html;
use yii\bootstrap\Nav as BootstrapNav;
use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;

/**
 * Class NavTop
 *
 * @package app\components\widgets
 */
class NavTop extends BootstrapNav
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        // load from parent class
        parent::init();
        $this->dropdownClass = 'yii\bootstrap\Dropdown';
        Html::addCssClass($this->options, ['widget' => 'nav']);
    }
    /**
     * Renders a widget's item.
     * @param string|array $item the item to render.
     * @return string the rendering result.
     * @throws InvalidConfigException
     */
    public function renderItem($item)
    {
        if (is_string($item)) {
            return $item;
        }
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }
        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', '#');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);

        if (isset($item['active'])) {
            $active = ArrayHelper::remove($item, 'active', false);
        } else {
            $active = $this->isItemActive($item);
        }

        // auto add
        if (empty($items)) {
            Html::addCssClass($options, ['widget' => 'dropdown']);
            $items = '';
        } else {
            // add extra menus
            $linkOptions['data-toggle'] = 'dropdown';
            $linkOptions['role'] = 'button';
            $linkOptions['aria-haspopup'] = 'true';
            $linkOptions['aria-expanded'] = 'false';

            Html::addCssClass($options, ['widget' => 'dropdown']);
            Html::addCssClass($linkOptions, ['widget' => 'dropdown-toggle']);
            if (is_array($items)) {
                $items = $this->isChildActive($items, $active);
                $items = $this->renderDropdown($items, $item);
            }
        }

        if ($active) {
            Html::addCssClass($options, 'active');
        }

        return Html::tag('li', Html::a($label, $url, $linkOptions) . $items, $options);
    }
    /**
     * Renders the given items as a dropdown.
     * This method is called to create sub-menus.
     * @param array $items the given items. Please refer to [[Dropdown::items]] for the array structure.
     * @param array $parentItem the parent item information. Please refer to [[items]] for the structure of this array.
     * @return string the rendering result.
     * @since 2.0.1
     */
    protected function renderDropdown($items, $parentItem)
    {
        /** @var Widget $dropdownClass */
        $dropDownClass = $this->dropdownClass;
        $useDropDownMultiColumn = ArrayHelper::getValue($parentItem, 'dropDownMultiColumn', false);

        if ($useDropDownMultiColumn) {
            Html::addCssClass($parentItem['dropDownOptions'], ['class' => 'dropdown-column']);
            $renderedDropDownMenu = "<div class='dropdown-multi-column'>\n";
            if (is_array($items) && count($items) > 0 && is_array($items[0])) {
                foreach ($items as $item) {
                    $renderedDropDownMenu .= $dropDownClass::widget([
                        'options' => ArrayHelper::getValue($parentItem, 'dropDownOptions', []),
                        'items' => $item,
                        'encodeLabels' => $this->encodeLabels,
                        'clientOptions' => false,
                        'view' => $this->getView(),
                    ]);
                }
            } else {
                $renderedDropDownMenu .= $dropDownClass::widget([
                    'options' => ArrayHelper::getValue($parentItem, 'dropDownOptions', []),
                    'items' => $items,
                    'encodeLabels' => $this->encodeLabels,
                    'clientOptions' => false,
                    'view' => $this->getView(),
                ]);
            }
            $renderedDropDownMenu .= "\n</div>";

            return $renderedDropDownMenu;
        } else {
            return $dropDownClass::widget([
                'options' => ArrayHelper::getValue($parentItem, 'dropDownOptions', []),
                'items' => $items,
                'encodeLabels' => $this->encodeLabels,
                'clientOptions' => false,
                'view' => $this->getView(),
            ]);
        }
    }
}