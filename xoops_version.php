<?php
$modversion['name'] = _MI_WEBINDEX_MODULE_NAME;
$modversion['version'] = "1.21";
$modversion['description'] = _MI_WEBINDEX_DESC;
$modversion['credits'] = "";
$modversion['author'] = "Solo & Hervé";
$modversion['help'] = "";
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 0;
$modversion['image'] = "images/webindex_slogo.png";
$modversion['dirname'] = "webindex";

$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'][0] = "webindex";

$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

$modversion['hasMain'] = 1;

// Templates
$modversion['templates'][1]['file'] = 'webindex_index.html';
$modversion['templates'][1]['description'] = 'List the indexes';

// Blocks
$modversion['blocks'][1]['file'] = "webindex_index.php";
$modversion['blocks'][1]['name'] = _MI_WEBINDEX_BNAME_01;
$modversion['blocks'][1]['description'] = _MI_WEBINDEX_BDESC_01;
$modversion['blocks'][1]['show_func'] = "b_webindex_show";
$modversion['blocks'][1]['edit_func'] = "b_webindex_edit";
$modversion['blocks'][1]['options'] = "0|1|1|1|1|1|1|1|0|0|0|0";
$modversion['blocks'][1]['template'] = 'webindex_block_index.html';

$modversion['blocks'][2]['file'] = "webindex_index.php";
$modversion['blocks'][2]['name'] = _MI_WEBINDEX_BNAME_02;
$modversion['blocks'][2]['description'] = _MI_WEBINDEX_BDESC_02;
$modversion['blocks'][2]['show_func'] = "b_webindex_show";
$modversion['blocks'][2]['edit_func'] = "b_webindex_edit";
$modversion['blocks'][2]['options'] = "1|0|0|0|0|0|0|0|0|0|0|0";
$modversion['blocks'][2]['template'] = 'webindex_block_index.html';


// Search
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = "include/search.inc.php";
$modversion['search']['func'] = "webindex_search";

// Smarty
$modversion['use_smarty'] = 1;

// Options
// First Columns names
$modversion['config'][1]['name'] = 'columnname01';
$modversion['config'][1]['title'] = '_MI_COL01_DESC';
$modversion['config'][1]['description'] = '';
$modversion['config'][1]['formtype'] = 'textbox';
$modversion['config'][1]['valuetype'] = 'text';
$modversion['config'][1]['default'] = _MI_WEBINDEX_ZONE01;

$modversion['config'][2]['name'] = 'columnname02';
$modversion['config'][2]['title'] = '_MI_COL02_DESC';
$modversion['config'][2]['description'] = '';
$modversion['config'][2]['formtype'] = 'textbox';
$modversion['config'][2]['valuetype'] = 'text';
$modversion['config'][2]['default'] = _MI_WEBINDEX_ZONE02;

$modversion['config'][3]['name'] = 'columnname03';
$modversion['config'][3]['title'] = '_MI_COL03_DESC';
$modversion['config'][3]['description'] = '';
$modversion['config'][3]['formtype'] = 'textbox';
$modversion['config'][3]['valuetype'] = 'text';
$modversion['config'][3]['default'] = _MI_WEBINDEX_ZONE03;

$modversion['config'][4]['name'] = 'columnname04';
$modversion['config'][4]['title'] = '_MI_COL04_DESC';
$modversion['config'][4]['description'] = '';
$modversion['config'][4]['formtype'] = 'textbox';
$modversion['config'][4]['valuetype'] = 'text';
$modversion['config'][4]['default'] = _MI_WEBINDEX_ZONE04;

$modversion['config'][5]['name'] = 'columnname05';
$modversion['config'][5]['title'] = '_MI_COL05_DESC';
$modversion['config'][5]['description'] = '';
$modversion['config'][5]['formtype'] = 'textbox';
$modversion['config'][5]['valuetype'] = 'text';
$modversion['config'][5]['default'] = _MI_WEBINDEX_ZONE05;

$modversion['config'][6]['name'] = 'columnname06';
$modversion['config'][6]['title'] = '_MI_COL06_DESC';
$modversion['config'][6]['description'] = '';
$modversion['config'][6]['formtype'] = 'textbox';
$modversion['config'][6]['valuetype'] = 'text';
$modversion['config'][6]['default'] = _MI_WEBINDEX_ZONE06;

$modversion['config'][7]['name'] = 'columnname07';
$modversion['config'][7]['title'] = '_MI_COL07_DESC';
$modversion['config'][7]['description'] = '';
$modversion['config'][7]['formtype'] = 'textbox';
$modversion['config'][7]['valuetype'] = 'text';
$modversion['config'][7]['default'] = _MI_WEBINDEX_ZONE07;

$modversion['config'][8]['name'] = 'columnname08';
$modversion['config'][8]['title'] = '_MI_COL08_DESC';
$modversion['config'][8]['description'] = '';
$modversion['config'][8]['formtype'] = 'textbox';
$modversion['config'][8]['valuetype'] = 'text';
$modversion['config'][8]['default'] = _MI_WEBINDEX_ZONE08;

$modversion['config'][9]['name'] = 'columnname09';
$modversion['config'][9]['title'] = '_MI_COL09_DESC';
$modversion['config'][9]['description'] = '';
$modversion['config'][9]['formtype'] = 'textbox';
$modversion['config'][9]['valuetype'] = 'text';
$modversion['config'][9]['default'] = _MI_WEBINDEX_ZONE09;

$modversion['config'][10]['name'] = 'columnname10';
$modversion['config'][10]['title'] = '_MI_COL10_DESC';
$modversion['config'][10]['description'] = '';
$modversion['config'][10]['formtype'] = 'textbox';
$modversion['config'][10]['valuetype'] = 'text';
$modversion['config'][10]['default'] = _MI_WEBINDEX_ZONE10;

// Columns visibility
$modversion['config'][11]['name'] = 'columnvisibility01';
$modversion['config'][11]['title'] = '_MI_COL01_VISIB';
$modversion['config'][11]['description'] = '';
$modversion['config'][11]['formtype'] = 'yesno';
$modversion['config'][11]['valuetype'] = 'int';
$modversion['config'][11]['default'] = 1;

$modversion['config'][12]['name'] = 'columnvisibility02';
$modversion['config'][12]['title'] = '_MI_COL02_VISIB';
$modversion['config'][12]['description'] = '';
$modversion['config'][12]['formtype'] = 'yesno';
$modversion['config'][12]['valuetype'] = 'int';
$modversion['config'][12]['default'] = 1;

$modversion['config'][13]['name'] = 'columnvisibility03';
$modversion['config'][13]['title'] = '_MI_COL03_VISIB';
$modversion['config'][13]['description'] = '';
$modversion['config'][13]['formtype'] = 'yesno';
$modversion['config'][13]['valuetype'] = 'int';
$modversion['config'][13]['default'] = 1;

$modversion['config'][14]['name'] = 'columnvisibility04';
$modversion['config'][14]['title'] = '_MI_COL04_VISIB';
$modversion['config'][14]['description'] = '';
$modversion['config'][14]['formtype'] = 'yesno';
$modversion['config'][14]['valuetype'] = 'int';
$modversion['config'][14]['default'] = 1;

$modversion['config'][15]['name'] = 'columnvisibility05';
$modversion['config'][15]['title'] = '_MI_COL05_VISIB';
$modversion['config'][15]['description'] = '';
$modversion['config'][15]['formtype'] = 'yesno';
$modversion['config'][15]['valuetype'] = 'int';
$modversion['config'][15]['default'] = 1;

$modversion['config'][16]['name'] = 'columnvisibility06';
$modversion['config'][16]['title'] = '_MI_COL06_VISIB';
$modversion['config'][16]['description'] = '';
$modversion['config'][16]['formtype'] = 'yesno';
$modversion['config'][16]['valuetype'] = 'int';
$modversion['config'][16]['default'] = 1;

$modversion['config'][17]['name'] = 'columnvisibility07';
$modversion['config'][17]['title'] = '_MI_COL07_VISIB';
$modversion['config'][17]['description'] = '';
$modversion['config'][17]['formtype'] = 'yesno';
$modversion['config'][17]['valuetype'] = 'int';
$modversion['config'][17]['default'] = 1;

$modversion['config'][18]['name'] = 'columnvisibility08';
$modversion['config'][18]['title'] = '_MI_COL08_VISIB';
$modversion['config'][18]['description'] = '';
$modversion['config'][18]['formtype'] = 'yesno';
$modversion['config'][18]['valuetype'] = 'int';
$modversion['config'][18]['default'] = 0;

$modversion['config'][19]['name'] = 'columnvisibility09';
$modversion['config'][19]['title'] = '_MI_COL09_VISIB';
$modversion['config'][19]['description'] = '';
$modversion['config'][19]['formtype'] = 'yesno';
$modversion['config'][19]['valuetype'] = 'int';
$modversion['config'][19]['default'] = 0;

$modversion['config'][20]['name'] = 'columnvisibility10';
$modversion['config'][20]['title'] = '_MI_COL10_VISIB';
$modversion['config'][20]['description'] = '';
$modversion['config'][20]['formtype'] = 'yesno';
$modversion['config'][20]['valuetype'] = 'int';
$modversion['config'][20]['default'] = 0;

$modversion['config'][21]['name'] = 'admin_show';
$modversion['config'][21]['title'] = '_MI_ADMIN_SHOW';
$modversion['config'][21]['description'] = '';
$modversion['config'][21]['formtype'] = 'yesno';
$modversion['config'][21]['valuetype'] = 'int';
$modversion['config'][21]['default'] = 1;

$modversion['config'][22]['name'] = 'columndefault01';
$modversion['config'][22]['title'] = '_MI_COL01_DEFTXT';
$modversion['config'][22]['formtype'] = 'textarea';
$modversion['config'][22]['valuetype'] = 'text';
$modversion['config'][22]['default'] = '';

$modversion['config'][23]['name'] = 'columndefault02';
$modversion['config'][23]['title'] = '_MI_COL02_DEFTXT';
$modversion['config'][23]['formtype'] = 'textarea';
$modversion['config'][23]['valuetype'] = 'text';
$modversion['config'][23]['default'] = '';

$modversion['config'][24]['name'] = 'columndefault03';
$modversion['config'][24]['title'] = '_MI_COL03_DEFTXT';
$modversion['config'][24]['formtype'] = 'textarea';
$modversion['config'][24]['valuetype'] = 'text';
$modversion['config'][24]['default'] = '';

$modversion['config'][25]['name'] = 'columndefault04';
$modversion['config'][25]['title'] = '_MI_COL04_DEFTXT';
$modversion['config'][25]['formtype'] = 'textarea';
$modversion['config'][25]['valuetype'] = 'text';
$modversion['config'][25]['default'] = '';

$modversion['config'][26]['name'] = 'columndefault05';
$modversion['config'][26]['title'] = '_MI_COL05_DEFTXT';
$modversion['config'][26]['formtype'] = 'textarea';
$modversion['config'][26]['valuetype'] = 'text';
$modversion['config'][26]['default'] = '';

$modversion['config'][27]['name'] = 'columndefault06';
$modversion['config'][27]['title'] = '_MI_COL06_DEFTXT';
$modversion['config'][27]['formtype'] = 'textarea';
$modversion['config'][27]['valuetype'] = 'text';
$modversion['config'][27]['default'] = '';

$modversion['config'][28]['name'] = 'columndefault07';
$modversion['config'][28]['title'] = '_MI_COL07_DEFTXT';
$modversion['config'][28]['formtype'] = 'textarea';
$modversion['config'][28]['valuetype'] = 'text';
$modversion['config'][28]['default'] = '';

$modversion['config'][29]['name'] = 'columndefault08';
$modversion['config'][29]['title'] = '_MI_COL08_DEFTXT';
$modversion['config'][29]['formtype'] = 'textarea';
$modversion['config'][29]['valuetype'] = 'text';
$modversion['config'][29]['default'] = '';

$modversion['config'][30]['name'] = 'columndefault09';
$modversion['config'][30]['title'] = '_MI_COL09_DEFTXT';
$modversion['config'][30]['formtype'] = 'textarea';
$modversion['config'][30]['valuetype'] = 'text';
$modversion['config'][30]['default'] = '';

$modversion['config'][31]['name'] = 'columndefault10';
$modversion['config'][31]['title'] = '_MI_COL10_DEFTXT';
$modversion['config'][31]['formtype'] = 'textarea';
$modversion['config'][31]['valuetype'] = 'text';
$modversion['config'][31]['default'] = '';

$modversion['config'][32]['name'] = 'defaulturl';
$modversion['config'][32]['title'] = '_MI_URL_DEFTXT';
$modversion['config'][32]['formtype'] = 'textbox';
$modversion['config'][32]['valuetype'] = 'text';
$modversion['config'][32]['default'] = '';

?>