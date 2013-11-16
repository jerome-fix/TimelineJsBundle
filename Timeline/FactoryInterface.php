<?php

namespace Zapoyok\TimelineJsBundle\Timeline;

/**
 * Interface implemented by the factory to create items
 */
interface FactoryInterface
{
    /**
     * Creates a timeline item
     *
     * @param string $name
     * @param array $options
     * @return \Zapoyok\TimelineJsBundle\Timeline\ItemInterface
     */
    function createItem($name, array $options = array());

}
