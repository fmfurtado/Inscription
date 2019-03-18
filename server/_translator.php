<?php
class Translator {

    private $languageCode  = 'en';
    private $languageNames = array();
	private $lang 		   = array();
	
	public function __construct($languageCode){
		$this->languageCode = $languageCode;
        $this->languageNames['en'] = 'lang/English.txt';
        $this->languageNames['fr'] = 'lang/Français.txt';
        $this->languageNames['pt'] = 'lang/Português.txt';
	}
	
    private function findString($str) {
        if (array_key_exists($str, $this->lang[$this->languageCode])) {
			return $this->lang[$this->languageCode][$str];
        }
        return $str;
    }
    
	private function splitStrings($str) {
        return explode('=', trim($str));
    }
    
    public function getLanguageCode() {
        return $this->languageCode;
    }
    
	public function __($str, $arg1 = "", $arg2 = "", $arg3 = "") {
        if (!array_key_exists($this->languageCode, $this->lang)) {
            $filename = $this->languageNames[$this->languageCode];
            if (file_exists($filename)) {
                $strings = array_map(array($this,'splitStrings'), file($filename));
                foreach ($strings as $k => $v) {
					$this->lang[$this->languageCode][$v[0]] = $v[1];
                }
                $toReturn = $this->findString($str);
            } else {
                $toReturn = $str;
            }
        } else {
            $toReturn = $this->findString($str);
        }
        
        // Documentation to generate: <body text='black'>
        // $bodytag = str_replace("%1", "black", "<body text='%1'>");
        
        if (strpos($toReturn, "%1") !== false && $arg1 != "") {
            $toReturn = str_replace("%1", $arg1, $toReturn);
        }
        
        if (strpos($toReturn, "%2") !== false && $arg2 != "") {
            $toReturn = str_replace("%2", $arg2, $toReturn);
        }
        
        if (strpos($toReturn, "%3") !== false && $arg3 != "") {
            $toReturn = str_replace("%3", $arg3, $toReturn);
        }
        
        return $toReturn;
    }
}
?>