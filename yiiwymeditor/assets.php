<?php

return array(
	'yiidhtmlx/core' => array(
		'sourcePath' => __DIR__ . '/assets',
		'js' => array(
			'dhtmlxcommon.js',
		),
	),
	'yiidhtmlx/chart' => array(
		'sourcePath' => __DIR__ . '/assets/dhtmlxChart',
		'js' => array(
			'dhtmlxchart.js',
		),
		'css'=>array(
			'dhtmlxchart.css'
		),
		'depends' => array('yiidhtmlx/core'),
	),
	'yiidhtmlx/menuObject' => array(
		'sourcePath' => __DIR__ . '/assets/dhtmlxMenu',
		'js' => array(
			'dhtmlxmenu.js',
			'ext/dhtmlxmenu_ext.js'
		),
		'css'=>array(
			'skins/dhtmlxmenu_dhx_terrace.css'
		),
		'depends' => array('yiidhtmlx/core'),
	),	
	'yiidhtmlx/gridObject' => array(
		'sourcePath' => __DIR__ . '/assets/dhtmlxGrid',
		'js' => array(
			'dhtmlxgrid.js',
			'dhtmlxgridcell.js',
			'ext/dhtmlxgrid_srnd.js',
			'ext/dhtmlxgrid_filter.js',
		),
		'css'=>array(
			'dhtmlxgrid.css',
			'skins/dhtmlxgrid_dhx_terrace.css'
		),
		'depends' => array('yiidhtmlx/core'),
	),
	'yiidhtmlx/treeObject' => array(
		'sourcePath' => __DIR__ . '/assets/dhtmlxTree',
		'js' => array(
			'dhtmlxtree.js',
			'ext/dhtmlxtree_json.js',
			'ext/dhtmlxtree_dragin.js',
			'ext/dhtmlxtree_xw.js',
		),
		'css'=>array(
			'dhtmlxtree.css',
		),
		'depends' => array('yiidhtmlx/core'),
	)
);
