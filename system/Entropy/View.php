<?php

namespace ED\Entropy;

use \InvalidArgumentException;
use \Psr\Http\Message\ResponseInterface;

class View{

	protected $templatePath;

	//protected $attributes;
	protected $data;
	protected $data_c;

	protected $layout;

	//public function __construct($templatePath = "", $attributes = [], $layout = ""){
	public function __construct($templatePath = "", $layout = ""){
		$this->templatePath = rtrim($templatePath, '/\\') . '/';
		//$this->attributes = $attributes;
		$this->setLayout($layout);
	}

	public function render(ResponseInterface $response, $template, array $data = []){

		$output = $this->fetch($template, $data);

		if ($this->layout !== null) {
			ob_start();

			//get the layout path in a different variable
			$tmp_layout = $this->layout;
			//to only include the layout once we make $this->layout = null so if we fetch anything in the layout file this is not called recursively 
			$this->layout = null;
			
			$data['content'] = $output;
			$this->protectedIncludeScope($tmp_layout, $data);
			$output = ob_get_clean(); 

		}//end if

		$response->getBody()->write($output);

		return $response;
	}

	public function getLayout(){
		return $this->layout;
	}

	public function setLayout($layout){
		if ($layout === "" || $layout === null) {
			$this->layout = null;
		} else {
			$layoutPath = $this->templatePath . $layout;
			if (!is_file($layoutPath)) {
				throw new \RuntimeException("Layout template `$layout` does not exist");
			}
			$this->layout = $layoutPath;
		}
	}

	public function addDataCollection($key, $value){
		if (!isset($this->data_c[$key])){
			$this->data_c[$key] = array();
		}    	
		$this->data_c[$key][] = $value;

		return $this;
	}

	public function addData($key, $value){

		if (!isset($this->data[$key])){
			$this->data[$key] = $value;
			return $this;
		}

	}

	public function getData($key){
		if (!isset($this->data[$key])){
			return false;
		}	

		return $this->data[$key];
	}

	public function getDataCollection($key){
		if (!isset($this->data_c[$key])){
			return false;
		}

		return $this->data_c[$key];
	}

	public function getAttributes(){
		return $this->attributes;
	}

	public function setAttributes(array $attributes){
		$this->attributes = $attributes;
	}

	public function addAttribute($key, $value) {
		$this->attributes[$key] = $value;
	}

	public function getAttribute($key) {
		if (!isset($this->attributes[$key])) {
			return false;
		}

		return $this->attributes[$key];
	}

	public function getTemplatePath(){
		return $this->templatePath;
	}

	public function setTemplatePath($templatePath){
		$this->templatePath = rtrim($templatePath, '/\\') . '/';
	}

	public function fetch($template, array $data = []) {
		if (isset($data['template'])) {
			throw new \InvalidArgumentException("Duplicate template key found");
		}

		if (!is_file($this->templatePath . $template)) {
			throw new \RuntimeException("View cannot render `$template` because the template does not exist");
		}

		//$data = array_merge($this->attributes, $data);

		try {
			ob_start();
			$this->protectedIncludeScope($this->templatePath . $template, $data);
			$output = ob_get_clean();

			// if ($this->layout !== null) {
   //              ob_start();

   //              //get the layout path in a different variable
   //              $tmp_layout = $this->layout;
   //              //to only include the layout once we make $this->layout = null so if we fetch anything in the layout file this is not called recursively 
   //              $this->layout = null;
				
   //              $data['content'] = $output;
   //              $this->protectedIncludeScope($tmp_layout, $data);
   //              $output = ob_get_clean(); 

   //          }

		} catch(\Throwable $e) { // PHP 7+
			ob_end_clean();
			throw $e;
		} catch(\Exception $e) { // PHP < 7
			ob_end_clean();
			throw $e;
		}

		return $output;
	}

	protected function protectedIncludeScope ($template, array $data) {
		extract($data);
		include $template;
	}

}

?>