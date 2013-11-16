<?php

namespace Zapoyok\TimelineJsBundle\Twig;

/**
 * @author zapoyok
 *
 */
class TimelineExtension extends \Twig_Extension
{

    protected $ressources = array();
    protected $environment;

    /**
     * {@inheritdoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getFunctions()
    {
        return array(
            'zapoyok_timelinejs_display' => new \Twig_Function_Method($this, 'display', array('is_safe' => array('html'))),
        );
    }

    /**
     * @param string $template
     * @param array  $parameters
     *
     * @return mixed
     */
    public function render($template, array $parameters = array())
    {

        if (!isset($this->ressources[$template])) {
            $this->ressources[$template] = $this->environment->loadTemplate($template);
        }

        return $this->ressources[$template]->render($parameters);
    }

    /**
     * Renders a menu with the specified renderer.
     *
     * @param \Zapoyok\TimelineJsBundle\Timeline\ItemInterface|string|array $menu
     * @param array $options
     * @return string
     */
    public function display($items, array $options = array())
    {

        $options = array_merge(array(
            'min' => null,
            'max' => null,
            'width' => '100%',
            'height' => 'auto',
            'minHeight' => '300',
            'style' => 'dot',
            'showNavigation' => true,
            'animate' => true,
            'locale' => 'en',
            'timelineID' => 'timeline'
                ), $options);
        
        
//        var_dump($options);exit();
        $ret = $this->render("ZapoyokTimelineJsBundle:Twig:datasource.html.twig", array(
            'items' => $items->getChildren(),
            'options' => $options,
        ));
        return $ret;
    }

    public function getName()
    {
        return 'timeline_extension';
    }

}
