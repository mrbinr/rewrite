<?php

namespace Mrbinr\RewriteBundle\Listener;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Mrbinr\RewriteBundle\Util\Rewriter;

class RewriteListener implements EventSubscriber
{
    public $reader;

    public function __construct(AnnotationReader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * Specifies the list of events to listen
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(
            'prePersist',
        );
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getObject();
        $reflection = new \ReflectionClass($entity);
        $properties = $reflection->getProperties();
        $property = null;
        $sourceProp = null;
        $namespace = str_replace('Listener','Annotation', __NAMESPACE__);
        $class = str_replace('Listener','',str_replace(__NAMESPACE__,'',__CLASS__));
        foreach ($properties as $prop) {
            $annotation = $this->reader->getPropertyAnnotation($prop, $namespace. $class);
            if (!empty($annotation)) {
                $property = $prop->getName();
                if (!empty($property) ) {
                    $entity->{'set'.ucfirst($property)}( $this->rewrite($entity, $annotation) );
                }
            }
        }
    }

    /**
     * @param $entity
     * @param $annotation
     * @return string
     */
    private function rewrite($entity, $annotation)
    {
        $string = '';
        foreach ($annotation->fields as $field) {
            if ($string!=='') {
                $string .= '-';
            }
            $string .= Rewriter::rewrite( $entity->{'get'.ucfirst($field)}(), $annotation->wordSeparator);
            foreach ($annotation->ancestors as $ancestor) {
                $ancestor = $entity->{'get' . ucfirst($ancestor)}();
                if ($ancestor) {
                    $string = $annotation->separatorWithAncestors . $string;
                    $string = $this->rewrite( $ancestor, $annotation) . $string;
                }
            }
        }

        return $string;
    }


}
