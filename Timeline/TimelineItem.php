<?php

namespace Zapoyok\TimelineJsBundle\Timeline;

/**
 * Default implementation of the ItemInterface
 */
class TimelineItem implements ItemInterface
{

    private $dateStart = null;
    private $dateEnd = null;
    private $content = null;
    private $group = null;
    private $className = null;

    /* Internal usage */
    private $name = null;
    private $children;
    private $parent;

    /**
     * Class constructor
     *
     * @param string $name
     * @param \Zapoyok\TimelineJsBundle\Timeline\FactoryInterface $factory
     */
    public function __construct($name, FactoryInterface $factory)
    {
        $this->name = (string) $name;
        $this->factory = $factory;
    }

    /**
     * @param  \Zapoyok\TimelineJsBundle\Timeline\FactoryInterface $factory
     * @return \Zapoyok\TimelineJsBundle\Timeline\ItemInterface
     */
    public function setFactory(FactoryInterface $factory)
    {
        $this->factory = $factory;

        return $this;
    }

    /**
     * Add a child menu item to this menu
     *
     * Returns the child item
     *
     * @param mixed $child   An ItemInterface instance or the name of a new item to create
     * @param array $options If creating a new item, the options passed to the factory for the item
     * @return \Zapoyok\TimelineJsBundle\Timeline\ItemInterface
     */
    public function addItem($item, array $options = array())
    {
        if (!$item instanceof ItemInterface) {
            $item = $this->factory->createItem($item, $options);
        } elseif (null !== $item->getParent()) {
            throw new \InvalidArgumentException('Cannot add timeline item as child, it already belongs to another timeline (e.g. has a parent).');
        }

        $item->setParent($this);

        $this->children[$item->getName()] = $item;

        return $item;
    }

    /**
     * Returns the child menu identified by the given name
     *
     * @param  string $name  Then name of the child menu to return
     * @return \Zapoyok\TimelineJsBundle\Timeline\ItemInterface|null
     */
    public function getChild($name)
    {
        return isset($this->children[$name]) ? $this->children[$name] : null;
    }

    /**
     * @return \Zapoyok\TimelineJsBundle\Timeline\ItemInterface|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Used internally when adding and removing children
     *
     * @param \Zapoyok\TimelineJsBundle\Timeline\ItemInterface $parent
     * @return \Zapoyok\TimelineJsBundle\Timeline\ItemInterface
     */
    public function setParent(ItemInterface $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return array of ItemInterface objects
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param  array $children An array of ItemInterface objects
     * @return \Zapoyok\TimelineJsBundle\Timeline\ItemInterface
     */
    public function setChildren(array $children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param  string $name
     * @return \Zapoyok\TimelineJsBundle\Timeline\ItemInterface
     */
    public function setName($name)
    {
        if ($this->name == $name) {
            return $this;
        }

        $parent = $this->getParent();
        if (null !== $parent && isset($parent[$name])) {
            throw new \InvalidArgumentException('Cannot rename item, name is already used by sibling.');
        }

        $oldName = $this->name;
        $this->name = $name;

        if (null !== $parent) {
            $names = array_keys($parent->getChildren());
            $items = array_values($parent->getChildren());

            $offset = array_search($oldName, $names);
            $names[$offset] = $name;

            $parent->setChildren(array_combine($names, $items));
        }

        return $this;
    }

    public function setDateStart(\DateTime $date)
    {
        $this->dateStart = $date->format('c');
        return $this;
    }

    public function setDateEnd(\DateTime $date)
    {
        $this->dateEnd = $date->format('c');
        return $this;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function setGroup($group)
    {
        $this->group = $group;
        return $this;
    }

    public function setClassName($class)
    {
        $this->className = $class;
        return $this;
    }

    public function getDateStart()
    {
        return $this->dateStart;
    }

    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getGroup()
    {
        return $this->group;
    }

    public function getClassName()
    {
        return $this->className;
    }

    /**
     * Implements Countable
     */
    public function count()
    {
        return count($this->children);
    }

    /**
     * Implements IteratorAggregate
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->children);
    }

    /**
     * Implements ArrayAccess
     */
    public function offsetExists($name)
    {
        return isset($this->children[$name]);
    }

    /**
     * Implements ArrayAccess
     */
    public function offsetGet($name)
    {
        return $this->getChild($name);
    }

    /**
     * Implements ArrayAccess
     */
    public function offsetSet($name, $value)
    {
        return $this->addChild($name)->setLabel($value);
    }

    /**
     * Implements ArrayAccess
     */
    public function offsetUnset($name)
    {
        $this->removeChild($name);
    }

}
