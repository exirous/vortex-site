
<?php Yii::import('zii.widgets.CPortlet');
 
class Links extends CPortlet
{
    public function init()
    {
        parent::init();
    }
 
    protected function renderContent()
    {
        $this->render('links');
    }
}

?>