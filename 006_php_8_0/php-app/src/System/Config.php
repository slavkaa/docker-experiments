<?php

namespace App\System;

class Config
{
    public static function getRootDir(): string
    {
        global $rootDir;
        return $rootDir;
    }
    
    public static function getPathToView($subPath): string
    {
        $caller = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['class'] ?? null;
        $className = null;
        
        if ($caller) {
            $className = basename(str_replace('\\', '/', $caller)) . '/';
        }
        
        return self::getRootDir() . 'src/views/' . $className . $subPath;
    }
}