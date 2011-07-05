<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

class ComAdvertsViewAdvertisementHtml extends ComDefaultViewHtml
{
	public function display()
	{

		$config = KFactory::get('admin::com.files.database.row.config');

		// prepare an extensions array for fancyupload
		$extensions = $config->upload_extensions;
		if(!empty($extensions))
		{
			foreach ($extensions as &$ext) {
				$ext = '*.'.$ext;
			}
			$str = implode('; ', $extensions);
		}
		else $str = '*.*';

		$this->assign('allowed_extensions', $str);
		$this->assign('maxsize'           , $config->upload_maxsize);
		//$this->assign('path'              , $state->identifier->relative_path);


		return parent::display();
	}
}
