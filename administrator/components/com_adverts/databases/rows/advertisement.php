<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

class ComAdvertsDatabaseRowAdvertisement extends KDatabaseRowDefault
{
	public function save()
	{	
		$modified = $this->getModified();
		$result = parent::save();
		
		if (in_array('zones', $modified))
		{
			$table = KFactory::get('admin::com.adverts.database.table.advertisement_zones');
			
			// delete any existing entries for campaign
			$table->select(array('aid' => $this->id))->delete();
			
			if (is_array($this->zones))
			{
				foreach($this->zones as $zone)
				{
					$table
						->select(null, KDatabase::FETCH_ROW)
						->setData(array(
							'aid'	=> $this->id,
							'zid'	=> $zone
						))
						->save();
					
				}
			}
		}
			
		
		$file = KRequest::get('files.file_url', 'filename');
		
		if ($file['name'] != '')
		{
			jimport('joomla.filesystem.file');
			jimport('joomla.filesystem.folder');
			
			// get filename. make safe. make lowercase
			$filename = strtolower(JFile::makeSafe($file['name']));
			
			
			/**
			 * folder
			 * 
			 * folder for storing the banners uploaded
			 *
			 * @todo adapt for parameters
			 */
			$pathBase = JPATH_SITE.DS.'images'.DS.'adverts';
			// if the folder does not exist, create folder
			if (!JFolder::exists($pathBase)) { 
				JFolder::create($pathBase, 0775);
			}
			
			// src file to move
			$src = $file['tmp_name'];
			// destination + filename + extension
			$dest = $pathBase.DS.$filename;

			file_put_contents($dest, $file);
			
			$this->file_url = $dest;
		}

		
		return (bool) $result;
	}
}