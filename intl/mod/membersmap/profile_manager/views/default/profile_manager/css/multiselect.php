<?php
?>
.ui-multiselect { display:none; padding:2px 0 2px 4px; text-align:left }
.ui-multiselect span.ui-icon { float:right }
.ui-multiselect-single .ui-multiselect-checkboxes input { position:absolute !important; top: auto !important; left:-9999px; }
.ui-multiselect-single .ui-multiselect-checkboxes label { padding:5px !important }

.ui-multiselect-header { margin-bottom:3px; padding:3px 0 3px 4px }
.ui-multiselect-header ul { font-size:0.9em }
.ui-multiselect-header ul li { float:left; padding:0 10px 0 0 }
.ui-multiselect-header a { text-decoration:none }
.ui-multiselect-header a:hover { text-decoration:underline }
.ui-multiselect-header span.ui-icon { float:left }
.ui-multiselect-header li.ui-multiselect-close { float:right; text-align:right; padding-right:0 }

.ui-multiselect-menu { display:none; padding:3px; position:absolute; z-index:10000; background: white; border: 1px solid #CCCCCC; }
.ui-multiselect-checkboxes { position:relative /* fixes bug in IE6/7 */; overflow-y:scroll }
.ui-multiselect-checkboxes label { cursor:default; display:block; border:1px solid transparent; padding:3px 1px }
.ui-multiselect-checkboxes label input { position:relative; top:1px }
.ui-multiselect-checkboxes li { clear:both; font-size:0.9em; padding-right:3px }
.ui-multiselect-checkboxes li.ui-multiselect-optgroup-label { text-align:center; font-weight:bold; border-bottom:1px solid }
.ui-multiselect-checkboxes li.ui-multiselect-optgroup-label a { display:block; padding:3px; margin:1px 0; text-decoration:none }

.ui-multiselect-checkboxes .ui-state-hover {
	background: #CCCCCC;
}

/* remove label borders in IE6 because IE6 does not support transparency */
* html .ui-multiselect-checkboxes label { border:none }
