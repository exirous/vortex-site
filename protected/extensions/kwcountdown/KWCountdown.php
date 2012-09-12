<?php

/**
 * KWCountdown - A wrapper for Keith Wood's jquery countdown widget. Localization
 * doesn't work as of yet.
 *  
 * How to use, put in view.
 * - count down to a date
 * $this->widget('ext.kwcountdown.KWCountdown', array('until_seconds' => $seconds_of_date));
 * - count down from a date
 * $this->widget('ext.kwcountdown.KWCountdown', array('until_seconds' => $seconds_of_date));
 * 
 * @author Alarice Earlene L. Chan
 */
class KWCountdown extends CWidget{
        
        //other options as defined by the jquery widget
        public $options = array();
        //until this unix timestamp - either since or until not both
        public $until_seconds;
        //since this unix timestamp - either since or until not both
        public $since_seconds;
        //countdown element id
        public $element_id = 'kw-countdown';
        //css file used for the widget
        public $cssFile;
        //javascript file for the widget
        public $jsFile;
        public $jsLocaleFile;

        //locale doesn't work a the moment(DO NOT SET AS SCRIPT WILL MALFUNCTION)
        public $locale;
        
        /*locales available for future modifications */
        private static $AVAILABLE_LOCALES = array(
            "ar", "bg", "bn", "ca", "cs", "da", "de", "el", "es", "et", "fa", 
            "fi", "fr", "gl", "he", "hr", "hu", "id", "it", "ja", "ko", "lt", 
            "lv", "ms", "my", "nb", "nl", "pl", "pt-BR", "ro", "ru", "sk", "sl", 
            "sr-SR", "sr", "sv", "th", "tr", "uk", "vi", "zh-CN", "zh-TW"
        );
               
        public function init() {    
            $path = Yii::app()->getAssetManager()->publish(
                    Yii::getPathOfAlias('ext.kwcountdown.src', -1, false));
            
            $this->jsFile = $path . '/jquery.countdown.js';
            $this->jsLocaleFile = $path . '/jquery.countdown-ru.js';
            $this->cssFile = $path . '/jquery.countdown.css';
            $cs = Yii::app()->clientScript;
            //$cs = new CClientScript;
            $cs->registerScriptFile($this->jsFile);
            $cs->registerScriptFile($this->jsLocaleFile);
            $cs->registerCssFile($this->cssFile);
            
           $jopts = '';
            if(!empty($this->options)){ 
                 $jopts = CJavaScript::encode($this->options);
            $idx = strrpos($jopts, '}');
            $jopts = substr($jopts, 0, $idx);
                $jopts .= ', ';
            }else $jopts .= '{';
            
            //unix timestamp to milliseconds 
            $millis = 0;
            if(isset($this->until_seconds)){
                $millis = $this->until_seconds * 1000;
                $jopts .= 'until: newYear}';
            }else if(isset($this->since_seconds)){
                $millis = $this->since_seconds * 1000;
                $jopts .= 'since: newYear}';
            }
            
            $script = "var newYear = new Date(); 
                newYear = new Date($millis);";
                
            /* Because locale doesn't work yet
            if(isset($this->locale) && in_array($this->locale, self::$AVAILABLE_LOCALES)){
                $cs->registerScriptFile($path . "/jquery.countdown-$this->locale.js");
                $script .= "$('$this->element_id').countdown($.countdown.regional['$this->locale']); 
                        $('$this->element_id').countdown($.extend($jopts, $.countdown.regional['$this->locale']));"; 
            }else{*/
                $script .= "$('#$this->element_id').countdown($jopts); ";
            //}
            /*
            $script = "var newYear = new Date(); 
                newYear = new Date($millis); 
                $('#$this->element_id').countdown({until: newYear}); ";
             * 
             */
            $cs->registerScript('count-down-script_'.$this->element_id, $script);
        }
        
        public function run() {
            echo "<div id=\"$this->element_id\"></div>";
        }
    
}

?>
