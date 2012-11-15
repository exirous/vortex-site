<?php
/**
 * User: RusMaxim
 * Date: 15.11.12
 * Time: 20:07
 */
class GuildCommand extends CConsoleCommand {
    public function actionLoad($guild_id = 1) {
        $guild = Guild::model()->findByPk($guild_id);
        if ($guild) {
            echo("Загружаю гильдию ".$guild->getFullName(true)."\n");
            if (Yii::app()->wowapi->GuildLoad($guild->name, $guild->realm->name)) {
                echo("Гильдия ".$guild->fullName." загружена\n");
                return 0;
            } else {
                echo("Ошибка загрузки гильдии ".$guild->fullName." загружена\n");
            };

        } else {
          echo ("Гильдия `".$guild_id."` не найдена.\n");
            return 1;
        }
        return 1;
    }
}
