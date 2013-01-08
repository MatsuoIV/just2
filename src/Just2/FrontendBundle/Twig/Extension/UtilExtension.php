<?php

namespace Just2\FrontendBundle\Twig\Extension;

class utilExtension extends \Twig_Extension {

// ...
    public function getName() {
        return 'cupon';
    }

    public function getFunctions() {
        return array(
            'estatebid' => new \Twig_Function_Method($this, 'estatebid')
        );
    }

    public function estatebid($estado) {
        switch ($estado) {
            case 1:
                return 'aceppted';
                break;
            case 2:
                return 'Pending acceptance';
                break;
            case 3:
                return 'Rejectered';
                break;
        }
    }

}
