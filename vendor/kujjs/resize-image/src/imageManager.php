<?php 

namespace kujjs\imageManager;


use Illuminate\Config\Repository as Config;
use Anakadote\ImageManager\ImageManager AS AnakadoteImageManager;

class imageManager extends AnakadoteImageManager
{

	protected $config;
	protected $resize_path;

	function __construct($error_filename = 'error.jpg')
	{
		parent::__construct($error_filename);
		
		$this->config = Config('imageManager');
		
	}
	
	/**
	 * generates images and routes according to selected size 	
	 * @param  string $file is the file with full path
	 * @param  string $size Is the key name of the predefined size in the configuration 
	 * @return kujjs\imageManager\imageManager
	 */
	public function make($file, $size = 'thumbnail')
	{
		$option = $this->getSizes($size);
		$this->resize_path = $this->getImagePath($file,
									$option['width'], 
									$option['height'],
									$option['mode'], 
									$option['quality']
								    );
		return $this;
	}

	/**
	 * @return string url of the image with the new size
	 */
	public function toUrl()
	{
		return url($this->resize_path);
	}

	/**
	 * return html tag img with custom attributes
	 * @param  array  $attributes attribute html [tag=>value]
	 * @return string             tag img with or without attributes 
	 */
	public function toHtml(array $attributes = [])
	{
		$attr = '';
		foreach ($attributes as $tag => $value) {
			$attr .=  ' "'. $tag .'"="'. $value .'" ';
		}

		return '<img src="'. $this->toUrl().'" '. $attr .' />';
	}

	/**
	 * get Array with all options of the one size
	 * @param  string $size Is the key name of the predefined size in the configuration 
	 * @return array        Are all options of the one size
	 */
    private function getSizes($size = 'thumbnail')
    {
    	if (!isset($this->config['sizes'][$size])){
    		throw new \Exception("The Size Selected: $size Is not Define");

    	}
    	return $this->config['sizes'][$size]; 
    }

    /**
     * Separate file name into name and paths    
     *
     * @param  string  $file
     */
    private function parseFileName(string $file)
    {
        $this->file      = $file;
        $this->file_path = dirname($this->file);
        $this->url_path  = str_replace(public_path(), "", $this->file_path);
        $this->filename  = str_replace($this->file_path, "", $this->file);
    }

    /**
     * delete an image with all its sizes
     * @param  string $file image with public path.    
     */
	public function delete($full_path)
	{
		$this->parseFileName($full_path);

		foreach ($this->getAllPathsOfOneFile()	as $path) {
			$this->deleteImage($path);
		}
		$this->deleteImage($full_path);

		return true;
	}

	/**
	 * @return Array Get all paths containing the file 
	 */
	public function getAllPathsOfOneFile()
	{
		$files = [];
		foreach ($this->config['sizes'] as $size) {
			
			$path = $this->getFullPath($size);

			if (file_exists($path) ) {
				array_push($files, $this->getFullPath($size));
			}
			
		}
		return $files;
	}

	/**
	 * get full path of one size
	 * @param  array  $size Are the options of the configuration
	 * @return string       
	 */
	private function getFullPath(array $size)
	{
		return $this->file_path.'/'.$size['width'].'-'.$size['height'].'/'.$size['mode'].$this->filename;
	}

	/**
	 * @return string resized file path
	 */
	public function __toString()
	{
		return $this->resize_path;
	}
}
