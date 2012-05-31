<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'homepage_news_view',
    'template'=>"{items}\n{pager}",
)); ?>