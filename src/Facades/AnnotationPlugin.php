<?php

namespace Polntantos\AnnotationPlugin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Polntantos\AnnotationPlugin\AnnotationPlugin
 */
class AnnotationPlugin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Polntantos\AnnotationPlugin\AnnotationPlugin::class;
    }
}
