<?php

namespace avikarsha\datepicker;

class Datepicker extends \yii\base\Widget
{
    public $clientOptions = [];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::input($this->name, $this->value, $this->options);
        }
        $this->registerPlugin();
    }

    protected function registerPlugin()
    {
        $view = $this->getView();

        DatepickerAsset::register($view);

        $id = $this->options['id'];

        $jsOptions = $this->clientOptions !== false && !empty($this->clientOptions)
        ? Json::encode($this->clientOptions)
        : '';

        $js = "jQuery('#$id').intlTelInput($jsOptions);";

        $view->registerJs($js);
    }
}
