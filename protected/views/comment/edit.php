<?php
/**
 * User: Русинов Максим
 * Date: 15.06.12
 * Time: 22:12
 */
?>

<?php
$this->breadcrumbs=array(
    'Редактировать комментарий',
);
?>
<h2>Редактировать комментарий</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
