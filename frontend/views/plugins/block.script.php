<?php
/**
 * 
 *
 * @author 
 * @link 
 * @copyright 
 * @license 
 */

function smarty_block_script($params, $content, $template, &$repeat) {
	$controller = $template->tpl_vars['this']->value;
	
	 if (!$repeat) { //tag opened
	 
	 	switch($params['position']) {
			case 'load':
				$position = CClientScript::POS_LOAD;
				break;
			case 'head':
				$position = CClientScript::POS_HEAD;
				break;
			case 'ready':
				$position = CClientScript::POS_READY;
				break;
			case 'end':
				$position = CClientScript::POS_END;
				break;
			default:
				$position = null;
		}
		$controller->registerScript($params['id'], $content, $position);
	 }
}
