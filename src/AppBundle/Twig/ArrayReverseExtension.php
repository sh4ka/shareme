<?php
/**
 * Created by PhpStorm.
 * User: jesus
 * Date: 17/01/15
 * Time: 18:24
 */

namespace AppBundle\Twig;


class ArrayReverseExtension extends \Twig_Extension {

    public function getFunctions()
    {
        return array(
            'arrayReverse' => new \Twig_Function_Method($this, array($this, 'arrayReverse')),
        );
    }

    public function arrayReverse(array $data)
    {
        return array_reverse($data);
    }

    public function getName()
    {
        return 'shareme_ArrayReverseExtension';
    }
}