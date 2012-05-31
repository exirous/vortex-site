<?php Yii::import('zii.widgets.CPortlet');
 
class HomepageNews extends CPortlet
{
    public function init()
    {
        parent::init();
    }
 
    protected function renderContent()
    {
		$dataProvider=new CActiveDataProvider('Post', array(
			'criteria'=>array(
		        'condition'=>'blog_id=1',
		        'order'=>'post_date DESC',
		        'with'=>'author'
		    ),
			'pagination'=>array(
            	'pageSize'=>5,
        	),
		));

        $this->render('homepage_news', array(
			'dataProvider'=>$dataProvider,	
		));
    }
}

?>