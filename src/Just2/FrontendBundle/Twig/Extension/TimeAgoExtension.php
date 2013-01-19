<?php
 
namespace Just2\FrontendBundle\Twig\Extension;
 
use Just2\FrontendBundle\Twig\Extension\TimeAgo;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
 
class TimeAgoExtension extends \Twig_Extension
{
    public function getFilters() 
    {
        return array(
            'time_ago'  => new \Twig_Filter_Method($this, 'time_ago')
        );
    }
 
    public function time_ago($value, $format = 'Y-m-d H:s') 
    {
        if(!($value instanceof \DateTime)) {
            $transformer = new DateTimeToStringTransformer(null, null, $format);
            $value = $transformer->reverseTransform($value);
        }
        return new TimeAgo($value);
    }
 
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'time_ago';
    }
 
 
}