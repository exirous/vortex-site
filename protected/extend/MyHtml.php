<?php
/**
 * Html extends CHtml
 */
class MyHtml extends CHtml
{
    public static function error($model,$attribute,$htmlOptions=array())
        {
                self::resolveName($model,$attribute); // turn [a][b]attr into attr
                $error=$model->getError($attribute);
                if($error!='')
                {
                        if(!isset($htmlOptions['class']))
                                $htmlOptions['class']=self::$errorMessageCss;
                        $htmlOptions['class'] .= ' help-inline';
                        return self::tag('span', $htmlOptions, $error);
                }
                else
                        return '';
        }
}
?>