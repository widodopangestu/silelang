<?php
/*
 * main.php
 * 'component' => array(
 *    'widgetFactory' => array(
 *      'widgets' => array(
 *          'FlexPaper' => array(
 *              'licenseKey' => 'licenseKey',
 *          ),
 *      ),
 *    ), 
 * ) 
 */
 
class FlexPaper extends CWidget
{
  public $viewerHeight;
  public $viewerWidth;
  public $viewerContainer;  
  public $sourceFile;
  public $path;
  public $options = array();
  public $licenseKey;
    
  private $_baseUrl;
  
  public function init()
  {        
  	//souyrce file
  	$swf = $this->getSwf($this->sourceFile);
  	//echo $swf;
  	$this->sourceFile = $this->path.$this->sourceFile.".swf";
  	
    // GET RESOURCE PATH
    $resources = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'resources';
    
    // PUBLISH FILES
    $this->_baseUrl = Yii::app()->assetManager->publish($resources, false, -1, YII_DEBUG);
  }
  
  public function getSwf($pdf){
  	require_once("lib/common.php"); 
	require_once("lib/pdf2swf_php5.php");

	$page="";
	$doc=$pdf;	
	$pos = strpos($doc, "/");
	$configManager = new Config();
	$swfFilePath = $configManager->getConfig('path.swf') . $doc  . $page. ".swf";
	$pdfFilePath = $configManager->getConfig('path.pdf') . $doc;

	if(	!validPdfParams($pdfFilePath,$doc,$page) )
		return "[Incorrect file specified]";
	else{
		$pdfconv=new pdf2swf();
		$output=$pdfconv->convert($doc,$page);
		if(rtrim($output) === "[Converted]"){
			
			if($configManager->getConfig('allowcache')){
				setCacheHeaders();
			}
			
			if(!$configManager->getConfig('allowcache') || ($configManager->getConfig('allowcache') && endOrRespond())){
				//header('Content-type: application/x-shockwave-flash');
				//header('Accept-Ranges: bytes');
				//header('Content-Length: ' . filesize($swfFilePath));
			
				return file_get_contents($swfFilePath);
			}
		}else
			return $output; //error messages etc
	}
  }
  
  public function run()
  {
    if(empty($this->sourceFile))
    {
      Yii::log('Source File is not set.', CLogger::LEVEL_ERROR, 'FlexPaper');
      return false;
    }
    
    // REGISTER JS SCRIPT
    $cs = Yii::app()->clientScript;
    $cs->registerCoreScript('jquery');
        
    if(empty($this->licenseKey))
    {      
      // FREE VERSION
      $cs->registerScriptFile($this->_baseUrl.'/flexpaper_flash_free.js');    
    }
    else
    {
      // LICENSE VERSION
      $cs->registerScriptFile($this->_baseUrl.'/flexpaper_flash.js');
    }
    
    // VIEWER SCRIPT OPTIONS
    $options = array_merge(
            array(
                'SwfFile' => $this->sourceFile,
                'Scale'   => 0.6,
                'ZoomTransition' => 'BOut',
                'ZoomTime'       => 0.5,
                'ZoomInterval'   => 0.1,
                'FitPageOnLoad'  => true,
                'FitWidthOnLoad' => true,
                'PrintEnabled'   => true,
                'FullScreenAsMaxWindow' => true,
                'ProgressiveLoading'    => true,
                'ViewModeToolsVisible' => true,
                'ZoomToolsVisible'     => true,
                'NavToolsVisible'      => true,
                'CursorToolsVisible'   => true,
                'SearchToolsVisible'   => true,
                /*'MinZoomSize'    => 0.2,
                'MaxZoomSize'    => 5,
                'SearchMatchAll' => false,
                'InitViewMode'   => 'Portrait',*/
                'localeChain' => 'en_US',                                
            ),
            $this->options
        );
    
    // FLEXPAPER LICENSE
    if(!empty($this->licenseKey))
    {            
      $options['key'] = "{$this->licenseKey}";
    }    
    
    $viewerHeight = $this->viewerHeight;
    if(empty($viewerHeight))
    {
      $viewerHeight = '800px';
    }
        
    $viewerWidth = $this->viewerWidth;
    if(empty($viewerWidth))
    {
      $viewerWidth = '600px';
    }
    
    $viewerContainer = $this->viewerContainer;
    if(empty($viewerContainer))
    {
      $viewerContainer = 'viewerPlaceHolder';
    }
        
    $htmlOptions = array(
        'id'    => $viewerContainer,
        'style' => "width:{$viewerWidth}; height:{$viewerHeight}; display:block;",
    );
    
    // FLEXPAPER VIEWER
    $viewerPath = $this->_baseUrl.'/FlexPaperViewerFree'; 
    
    // LICENSE VERSION
    if(!empty($this->licenseKey)) 
    {      
      $viewerPath = $this->_baseUrl.'/FlexPaperViewerNoPrint'; 
      //Enable Printing
      if($options['PrintEnabled'] == true)
      {
        $viewerPath = $this->_baseUrl.'/FlexPaperViewer';
      }
    }
    
    // GENERATE VIEWER    
    echo CHtml::tag('div', $htmlOptions, '&nbsp;');
    echo chr(13);
    
    // GENERATE VIEWER SCRIPT
    echo CHtml::openTag('script', array('type' => 'text/javascript'));
    echo chr(13);
    echo 'var fp = new FlexPaperViewer( ';
    echo "'{$viewerPath}', ";
    echo "'{$viewerContainer}', ";
    echo '{ config : { ';
    
    $optionCount = count($options);
    $index = 1;
    foreach($options as $parameter => $value)
    {
      $value = self::paramsFormatter($parameter, $value);
      echo "{$parameter} : {$value} ";
      echo ($index < $optionCount) ? ', ' : '';      
      $index++;
    }
    echo ' } }); '.chr(13);
    echo 'function onDocumentLoadedError(errMessage){ $("#viewerPlaceHolder").html(errMessage); }'.chr(13);
    echo CHtml::closeTag('script');            
  }
  
  private function paramsFormatter($parameter, $value)
  {
    switch($parameter)
    {
      case 'SwfFile':
        $value = "escape('{$value}')";
        break;
      
      case 'ZoomTransition':
      case 'InitViewMode':
      case 'localeChain':
      case 'key':
        $value = "'{$value}'";
        break;
      
      case 'FitPageOnLoad':
      case 'FitWidthOnLoad':
      case 'PrintEnabled':
      case 'FullScreenAsMaxWindow':
      case 'ProgressiveLoading':
      case 'SearchMatchAll':
      case 'ViewModeToolsVisible':
      case 'ZoomToolsVisible':
      case 'NavToolsVisible':
      case 'CursorToolsVisible':
      case 'SearchToolsVisible':
        $value = ( ($value == true) || ($value == 'true') ) ? 'true' : 'false';
        break;
      
      default:
        break;
    }
    
    return $value;
  }
}
?>
