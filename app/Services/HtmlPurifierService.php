<?php

namespace App\Services;

use HTMLPurifier;
use HTMLPurifier_Config;

class HtmlPurifierService
{
    private static $instance;

    public static function getInstance(): HTMLPurifier
    {
        if (!self::$instance) {
            $config = HTMLPurifier_Config::createDefault();

            $config->set('Core.LexerImpl', 'DirectLex');
            $config->set('Cache.DefinitionImpl', null);
            $config->set('HTML.Allowed', 'p,br,b,strong,i,em,a[href|title]');
            $config->set('AutoFormat.AutoParagraph', true);
            $config->set('Core.EscapeInvalidTags', false);

            self::$instance = new HTMLPurifier($config);
        }

        return self::$instance;
    }
}
