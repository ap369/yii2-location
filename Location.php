<?php

namespace ap369\yii2location;

/**
 * Location class
 */
class Location /*extends \yii\base\Widget*/
{

    /**
     * @return Position|null
     */
    public static function get($ip = null){

        if($ip == null){
            $ip = \Yii::$app->request->getUserIP();
        }



        return null;
    }


}
