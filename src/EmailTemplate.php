<?php

namespace Beaver\Dateval;

class EmailTemplate {
    public $path;
    
    private $templateExtenstion = ".html";
    private $template;
    
    public $parsedTemplate;
    
    public function __construct($path) {
        $path .= $this->templateExtenstion;
        
        if(!file_exists($path)) {
            throw new PathException("Provided email template doesn't exist on that location");
            
        } else {
            $this->path = $path;
            
            try {
                $this->template = $this->parsedTemplate = file_get_contents($this->path);
            } catch (Exception $ex) {
                $ex->getMessage();
            }
            
        }
    }
    
    /**
     * Method that parses email and switch all placeholders
     * @param type $event
     */
    public function parse( $event ) {
        $placeholders = get_object_vars($event);
        foreach($placeholders as $key => $plh) {
            if(gettype($plh) == "string") {
                $this->parsedTemplate = preg_replace("/{{".$key."}}/", $plh, $this->parsedTemplate);
            }
        }
    }
    
}
