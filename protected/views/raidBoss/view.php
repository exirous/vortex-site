<?php
/* @var $this RaidBossController */
/* @var $model RaidBoss */

$this->breadcrumbs=array(
	'Raid Bosses'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List RaidBoss', 'url'=>array('index')),
	array('label'=>'Create RaidBoss', 'url'=>array('create')),
	array('label'=>'Update RaidBoss', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RaidBoss', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RaidBoss', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->name; ?></h1>
    <div class="row">
        <div class="span3">
            <div data-spy="affix" data-offset-top="300" style="top:20px">
                <ul class="nav nav-list">
                    <li class="nav-header">Способности</li>
                    <?php
                    $display_menu = function ($ability){
                        return '<li><a href="#ability'.$ability->id.'">'.$ability->name."</a></li>";
                    };

                    $display_menu_childs = function ($childs){
                        return '<ul class="nav nav-list">'.$childs.'</ul>';
                    };

                    foreach ($model->raidRootBossAbilities as $raidRootBossAbility) {
                        echo $raidRootBossAbility->withChilds($display_menu, $display_menu_childs);
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="span6">
            <?php
            $display_description = function ($ability){
                return '<div id="ability'.$ability->id.'">'."<h4>".$ability->name."</h4>".$ability->description."</div>";
            };


            $display_description_childs = function ($childs){
                return '<div style="padding-left: 20px;">'.$childs.'</div>';
            };

            foreach ($model->raidRootBossAbilities as $raidRootBossAbility) {
                echo $raidRootBossAbility->withChilds($display_description, $display_description_childs);
            }
            ?>
        </div>
        <div class="span3">
            <ul class="nav nav-list">
                <li class="nav-header">Видео</li>
                <?php
                foreach ($response_video as $video) {
                    echo '<li><a href="'.$video["link"][0]["href"].'">'.$video["title"]['$t']."</a></li>";
                }

                ?>
                <li class="nav-header">Видео БЕТА</li>
                <?php
                foreach ($response_video_beta as $video) {
                    echo '<li><a href="'.$video["link"][0]["href"].'">'.$video["title"]['$t']."</a></li>";
                }

                ?>
            </ul>
        </div>
    </div>