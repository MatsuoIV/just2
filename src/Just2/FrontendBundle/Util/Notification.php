<?php

namespace Just2\FrontendBundle\Util;



class Notification {

    private $_to;
    private $_body;
    private $_theme;
    private $_subject;
    private $twig;

    public function __construct($to, $subject, $body, \Twig_Environment $twig, $theme = null) {
        $this->_body = $body;
        $this->_to = $to;
        $this->_subject = $subject;
        $this->_theme = $theme;
        $this->twig=$twig;
    }

    public function sendMail() {
        if (is_array($this->_to)) {
            $send=0;
            $notsend=0;
            foreach ($this->_to as $i => $to) {
                if (mail($to, $this->_subject, $this->body(), "From: name@yourdomain.com")) {
                    $send = +1;
                } else {
                    $notsend = +1;
                }
            }

            if ($send >= 1) {
                return true;
            } else {
                return false;
            }
        } else {
            if (mail($this->_to, $this->_subject, $this->body(), "From: name@yourdomain.com")) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function body() {
        return $this->twig->loadTemplate('Just2FrontendBundle:Util:notifications.html.twig', array(
                    'body' => $this->_body,
                    'theme' => $this->_theme
                )); 
    }

}

?>
