Installation
============

To begin, add the dependent bundles to the vendor/bundles directory. Add the following lines to the file deps::

    php composer.phar require zapoyok/timelinejs

Now, add the new `TimelineJS` Bundle to the kernel

.. code-block:: php

    <?php
    public function registerbundles()
    {
        return array(
            new Zapoyok\TimelineJsBundle\ZapoyokTimelineJsBundle(),
        );
    }

Integration
-----------

.. code-block:: html 
    
    <script type="text/javascript" src="bundles/zapoyoktimelinejs/timeline-min.js"></script>
    <script type="text/javascript" src="bundles/zapoyoktimelinejs/timeline-locales.js"></script>
    <link rel="stylesheet" type="text/css" href="bundles/zapoyoktimelinejs/timeline.css">


.. code-block:: php
    
    <?php
    
    namespace Acme\Bundle\AcmeBundle\Timeline;
    
    use Zapoyok\TimelineJsBundle\Timeline\FactoryInterface;
    use Zapoyok\TimelineJsBundle\Timeline\TimelineItem;
    
    /**
     * Factory to create a menu from a tree
     */
    class PeriodFactory implements FactoryInterface
    {
        public function createItem($name, array $options = array())
        {
            $item = new TimelineItem($name, $this);
    
            $options = array_merge(
                array(),
                $options
            );
    
            $item
                ->setDateEnd(…)
                ->setDateStart(…)
                ->setContent(…)
                ->setGroup(…)
                ->setClassName(…)
            ;
    
            return $item;
        }
    
    }
