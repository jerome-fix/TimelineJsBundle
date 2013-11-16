<?php

namespace Zapoyok\TimelineJsBundle\Timeline;


/**
 * Default implementation of the ItemInterface
 */
class TimelineManager 
{

    public static function createItem( $name, $factory) {
        return new TimelineItem($name, $factory);
    }
    
}