<?php
/**
 * User: Русинов Максим
 * Date: 10.06.12
 * Time: 16:14
 */
class MySQL {
    public static function timestampToMySqlString($timestamp){
        return Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', $timestamp);
    }
}
