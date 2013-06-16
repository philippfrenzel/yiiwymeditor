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

namespace yiiwymeditor;

use Yii;
use yii\base\Model;
use yii\base\View;
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
	 * @var array the HTML attributes for the widget container tag.
	 */
	public $options = array();
	
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

		/**
		* @param startLevel the heading to start with, default is 1
		*/
		if (!isset($this->clientOptions['startLevel'])) {
			$this->clientOptions['startLevel'] = '1';
		}

		parent::init();

	}

	/**
	 * Renders the widget.
	 */
	public function run()
	{
		echo Html::beginTag('div', $this->options) . "\n";
		echo Html::endTag('div')."\n";
		$this->registerPlugin();
	}

	/**
	* Registers a specific dhtmlx widget and the related events
	* @param string $name the name of the dhtmlx plugin
	*/
	protected function registerPlugin()
	{		
		$id = $this->options['id'];
		$scope = $this->scope;
		
		//get the displayed view and register the needed assets
		$view = $this->getView();
		$view->registerAssetBundle("yiiwymeditor/core");

		$js = array();
		
		$cleanOptions = Json::encode($this->clientOptions);
		$js[] = "$('#$id').tableOfContents('$scope',$cleanOptions)";
		
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
