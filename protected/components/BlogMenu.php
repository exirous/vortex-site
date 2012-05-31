
<?php Yii::import('zii.widgets.CPortlet');
 
class BlogMenu extends CPortlet
{
    public function init()
    {
        parent::init();
    }
 
    protected function renderContent()
    {
        $this->render('blogMenu');
    }
}

?>