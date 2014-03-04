<?php
/**
 * @link http://www.frenzel.net/
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

namespace yiiwymeditor;

use yii\web\AssetBundle;

class CoreAsset extends AssetBundle
{
    public $sourcePath = '@yiiwymeditor/yiiwymeditor/assets';
    public $css = array(
    	'skins/moono/editor.css'
    );
    public $js = array(
      'ckeditor.js'
    );
    public $depends = array(
    );
}
