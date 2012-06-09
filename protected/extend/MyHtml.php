<?php
/**
 * Html extends CHtml
 */
class MyHtml extends CHtml {

    public static function error($model,$attribute,$htmlOptions=array()) {
        self::resolveName($model,$attribute); 
        $error=$model->getError($attribute);

        if($error!='') {
            if(!isset($htmlOptions['class']))
                $htmlOptions['class']=self::$errorMessageCss;

            $htmlOptions['class'] .= ' help-inline';
            return self::tag('span', $htmlOptions, $error);
        } else return '';
    }

    public static function myFormatText($text) {
        $text = self::convertYoutubeLink($text);
        return $text;
    }

    public static function convertYoutubeLink($text) {
        return preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            "<div style=\"text-align:center\"><iframe width=\"450\" height=\"250\" src=\"http://www.youtube.com/embed/$1?wmode=transparent\" frameborder=\"0\" allowfullscreen></iframe></div>",$text);
    }

    public static function characterSpan($character) {
        if ($character) {
            return '<span class="character '.$character->warcraftClass->english_name.'">'.$character->name.'</span>';
        } else {
            return 'Не установлен основной персонаж';
        }
    }
}
?>