<?php
/**
 * MyActiveForm extends CActiveForm
 */
class MyActiveForm extends CActiveForm
{
        public function errorSummary($models,$header=null,$footer=null,$htmlOptions=array())
        {
                if (isset($htmlOptions['class'])) {
                        $htmlOptions['class'] .= ' alert alert-error';
                } else {
                        $htmlOptions['class'] = 'alert alert-error';
                }
                return parent::errorSummary($models,$header,$footer,$htmlOptions);
        }

        public function inputWithLabelAndError($model, $attribute, $html_input) {
                $html_label = $this->label($model, $attribute, array('class'=>'control-label')); 
                
                $html_error = $this->error($model, $attribute); 
                $html_controls = MyHtml::tag('div', array ('class'=>'controls'), $html_input.$html_error);

                $classControGroup = 'control-group';
                if($model->hasErrors($attribute)) {
                        $classControGroup .= ' error';     
                }
                $html = MyHtml::tag('div', array ('class'=> $classControGroup), $html_label.$html_controls);
                return $html;
        }

        public function error($model,$attribute,$htmlOptions=array(),$enableAjaxValidation=true,$enableClientValidation=true)
        {
                if(!$this->enableAjaxValidation)
                        $enableAjaxValidation=false;
                if(!$this->enableClientValidation)
                        $enableClientValidation=false;

                if(!isset($htmlOptions['class']))
                        $htmlOptions['class']=$this->errorMessageCssClass;

                if(!$enableAjaxValidation && !$enableClientValidation)
                        return MyHtml::error($model,$attribute,$htmlOptions);

                $id=CHtml::activeId($model,$attribute);
                $inputID=isset($htmlOptions['inputID']) ? $htmlOptions['inputID'] : $id;
                unset($htmlOptions['inputID']);
                if(!isset($htmlOptions['id']))
                        $htmlOptions['id']=$inputID.'_em_';

                $option=array(
                        'id'=>$id,
                        'inputID'=>$inputID,
                        'errorID'=>$htmlOptions['id'],
                        'model'=>get_class($model),
                        'name'=>$attribute,
                        'enableAjaxValidation'=>$enableAjaxValidation,
                );

                $optionNames=array(
                        'validationDelay',
                        'validateOnChange',
                        'validateOnType',
                        'hideErrorMessage',
                        'inputContainer',
                        'errorCssClass',
                        'successCssClass',
                        'validatingCssClass',
                        'beforeValidateAttribute',
                        'afterValidateAttribute',
                );
                foreach($optionNames as $name)
                {
                        if(isset($htmlOptions[$name]))
                        {
                                $option[$name]=$htmlOptions[$name];
                                unset($htmlOptions[$name]);
                        }
                }
                if($model instanceof CActiveRecord && !$model->isNewRecord)
                        $option['status']=1;

                if($enableClientValidation)
                {
                        $validators=isset($htmlOptions['clientValidation']) ? array($htmlOptions['clientValidation']) : array();

                        $attributeName = $attribute;
                        if(($pos=strrpos($attribute,']'))!==false && $pos!==strlen($attribute)-1) // e.g. [a]name
                        {
                                $attributeName=substr($attribute,$pos+1);
                        }

                        foreach($model->getValidators($attributeName) as $validator)
                        {
                                if($validator->enableClientValidation)
                                {
                                        if(($js=$validator->clientValidateAttribute($model,$attributeName))!='')
                                                $validators[]=$js;
                                }
                        }
                        if($validators!==array())
                                $option['clientValidation']="js:function(value, messages, attribute) {\n".implode("\n",$validators)."\n}";
                }

                $html=MyHtml::error($model,$attribute,$htmlOptions);
                if($html==='')
                {
                        if(isset($htmlOptions['style']))
                                $htmlOptions['style']=rtrim($htmlOptions['style'],';').';display:none';
                        else
                                $htmlOptions['style']='display:none';
                        $htmlOptions['class']='help-inline';
                        $html=CHtml::tag('span',$htmlOptions,'');
                }

                $this->attributes[$inputID]=$option;
                return $html;
        }
                
}
?>