<?php

namespace Dxstudio\CwtSDK;

class SignUtils
{
    private static function getListString( array $list )
    {

        $r = [];
        foreach ($list as $v){
            if( is_array($v) ){
                $r[] = self::getString( $v );
            }else{
                $r[] = $v;
            }
        }
        return '['. implode(',',$r) . ']';

    }

    private static function getString( array $p )
    {

        $r = [];
        ksort($p);
        foreach($p as $k=>$v){
            if( is_array($v) ){
                $r[] = $k . '=' . self::getListString( $v );
            }else{
                $r[] = $k . '=' . $v;
            }
        }
        return implode('&',$r);

    }

    public static function getSign( array $p, string $secret )
    {

        if(empty($p)) return '';
        $r = self::getString( $p );
        $r .= '&secret='.$secret;
        return md5($r);

    }

}