<?php
 
 /**
 * This class is merely used to publish a TOC based upon the headings within a defined container
 * @copyright Frenzel GmbH - www.frenzel.net
 * @link http://www.frenzel.net
 * @author Philipp Frenzel <philipp@frenzel.net>
 *
 *
 * Jquery Script from
 * @author Doug Neiner
 * @link http://fuelyourcoding.com/scripts/toc/
 * @license Open Sourced under the MIT License
 */

namespace philippfrenzel\yiiwymeditor;

use Yii;
use yii\base\Model;
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\base\Widget as BaseWidget;

class yiiwymeditor extends BaseWidget
{
	/**
	 * @var Model the data model that this widget is associated with.
	 */
	public $model;
	/**
	 * @var string the model attribute that this widget is associated with.
	 */
	public $attribute;
	/**
	 * @var string the input name. This must be set if [[model]] and [[attribute]] are not set.
	 */
	public $name;
	/**
	 * @var string the input value.
	 */
	public $value;

	/**
	* @var array the HTML attributes (name-value pairs) for the field container tag.
	* The values will be HTML-encoded using [[Html::encode()]].
	* If a value is null, the corresponding attribute will not be rendered.
	*/
	public $options = array(
		'class' => 'control-group',
	);

	/**
	 * @var array the HTML attributes for the widget container tag.
	 */
	public $inputOptions = array();

	/**
	 * @var array the HTML attributes for the widget container tag.
	 */
	public $clientOptions = array();


	/**
	 * Initializes the widget.
	 * If you override this method, make sure you call the parent implementation first.
	 */
	public function init()
	{
		if (!$this->hasModel() && $this->name === null) {
			throw new InvalidConfigException("Either 'name' or 'model' and 'attribute' properties must be specified.");
		}

		//checks for the element id
		if (!isset($this->options['id'])) {
			$this->options['id'] = $this->getId();
		}

		parent::init();

	}

	/**
	* Renders a field containing a text area.
	* The model attribute value will be used as the content in the textarea.
	* @param array $options the tag options in terms of name-value pairs. These will be rendered as
	* the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	* @return string the rendering result
	*/
	public function run()
	{
		$options = array_merge($this->options,$this->inputOptions);
		echo Html::activeTextarea($this->model, $this->attribute, $options);
		$this->registerPlugin();
	}

	/**
	* Registers a specific dhtmlx widget and the related events
	* @param string $name the name of the dhtmlx plugin
	*/
	protected function registerPlugin()
	{		
		$replaceId = $this->model->formName().'['.$this->attribute.']';

		//get the displayed view and register the needed assets
		$view = $this->getView();

		/** @var \yii\web\AssetBundle $assetClass */
		CoreAsset::register($view);
		
		$js = array();
		
		$cleanOptions = Json::encode($this->clientOptions);
		$js[] = "CKEDITOR.replace('$replaceId',$cleanOptions,";
		$js[] = "on: {";
	  $js[] = "  instanceReady: function() {";
	  $js[] = "          this.dataProcessor.htmlFilter.addRules( {";
	  $js[] = "              elements: {";
	  $js[] = "                  img: function( el ) {";
	  $js[] = "                      if ( !el.attributes.class )";
	  $js[] = "                          el.attributes.class = 'pinterest-image';";
	  $js[] = "                  }";
	  $js[] = "              }";
	  $js[] = "          } );";          
	  $js[] = "      }";
	  $js[] = "  }";
		$js[] = "}";
		$js[] = ");";
		$view->registerJs(implode("\n", $js),View::POS_READY);
	}

	/**
	 * @return boolean whether this widget is associated with a data model.
	 */
	protected function hasModel()
	{
		return $this->model instanceof Model && $this->attribute !== null;
	}

}
