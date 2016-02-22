<?php

namespace Mrbinr\RewriteBundle\Util;

class Rewriter
{
    private static $fromCaracters='àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ';
    private static $toCaracters='aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY';

    /**
     * @param $strToClean
     * @param $sepa
     * @return mixed|string
     */
    public static function rewrite($strToClean, $sepa)
    {
        if (mb_detect_encoding($strToClean)==='UTF-8') {
            $strToClean = mb_convert_encoding($strToClean, 'ISO-8859-1', 'UTF-8');
        }

        $strToClean = strtr($strToClean,
            mb_convert_encoding(self::$fromCaracters, 'ISO-8859-1', 'UTF-8'), self::$toCaracters) ;
        $strToClean = strtolower( str_replace(' ',
            $sepa, trim( preg_replace('#[^a-zA-Z0-9]#', ' ', $strToClean) ) ) );
        $strToClean = preg_replace('#\\'.$sepa.'+#', $sepa, $strToClean);
        $strToClean = preg_replace('#(['.$sepa.']+)#', $sepa, $strToClean);

        return $strToClean;
    }
}
