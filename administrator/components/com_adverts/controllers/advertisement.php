<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

class ComAdvertsControllerAdvertisement extends ComDefaultControllerDefault
{
	public function __construct(KConfig $config)
	{		
		parent::__construct($config);
	
		$this->registerCallback(array('after.add', 'after.edit'), array($this, 'setAttachments'));
	}
	
	public function setAttachments(KCommandContext $context)
	{
		jimport( 'joomla.filesystem.file' );
	
		$data			= $context['result'];

		if(is_a($data, 'KDatabaseRowsetInterface')) $data = (object) end($data->getData());
		$err			= null;
		$errors			= array();
		$identifier		= $this->getIdentifier();
		$destination	= JPATH_ROOT.'/media/'.$identifier->type.'_'.$identifier->package.'/attachments/';
		$attachment		= KRequest::get('files.file_upload', 'raw');
		
		if ($attachment['error'] == 0) {
		    //If no name is set, then we can't upload		    
		    if (trim($attachment['name'])) {
	
				$upload = JFile::makeSafe(uniqid(time())).'.'.JFile::getExt($attachment['name']);
		
				JFile::upload($attachment['tmp_name'], $destination.$upload);
				
				$type = 'image';
				if ($attachment['type'] == 'application/x-shockwave-flash') {
					$type = 'flash';
				}
				
				if ($data->alt_file_check == true && $type == 'image') {
					KFactory::tmp('site::com.adverts.model.advertisement')
						->id($data->id)
						->getItem()
						->setData(array(
							'alternative_file' => $upload
						))
						->save();
				} else {
				
					KFactory::tmp('site::com.adverts.model.advertisement')
						->id($data->id)
						->getItem()
						->setData(array(
							'primary_file' => $upload,
							'type'	=> $type
						))
						->save();
				}
				
				//Makes sure the page don't scroll after redirect when there are errors
				if($errors) $this->_redirect_hash = false;
				
				foreach ($errors as $error)
				{
					JError::raiseWarning(21, sprintf(JText::_("%s couldn't upload because %s"), $error['name'], lcfirst($error['error'])));
				}
		
				$item = KFactory::tmp('site::com.adverts.model.advertisement')
						->id(KRequest::get('post.file_url', 'int'))
						->getItem();
		
				//if(JFile::exists($destination.$item->file)) JFile::delete($destination.$item->file);
				//$item->delete();
			}
		}
	}
}