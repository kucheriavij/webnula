<?php
/**
 * @author
 * @version
 * @see
 * @link
 * @license
 */

class PostInstallCommand extends CConsoleCommand {
	private $writable = array(
		"application.runtime",
		
		"webroot.temp",
		"webroot.temp.app",
		"webroot.temp.backend",
		
		"webroot.assets",
		
		"webroot.common",
		"webroot.common.behaviors",
		"webroot.common.dataset",
		"webroot.common.elements",
		"webroot.common.forms",
		"webroot.common.models",
		"webroot.common.storage",
		
		"webroot.common.storage.Section",
		"webroot.common.storage.User",
		"webroot.common.storage.Media",
		"webroot.common.storage.Object",
		
		"webroot.media",
		"webroot.media._files",
		"webroot.media.files",
	);
	
	public function run($args)
	{
		Yii::setPathOfAlias('webroot', dirname(dirname(dirname(__FILE__))));
		foreach( $this->writable as $path )
		{
			$path = Yii::getPathOfAlias($path);
			echo "Setting writable: $path ...";
			if (is_dir($path)) {
				chmod($path, 0777);
			} else if( is_file($path.'.php') ) {
				chmod($path.'.php', 0666);
			} else {
				mkdir($path, 0777, true);
				chmod($path, 0777);
			}
			echo "done\n";
		}
	}
}
?>