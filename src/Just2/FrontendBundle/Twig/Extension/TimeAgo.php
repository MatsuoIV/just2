<?php

namespace Just2\FrontendBundle\Twig\Extension;

class TimeAgo {

    protected $strings = array(
        'y' => array('ends in 1 years', 'ends in %d years'),
        'm' => array('ends in 1 months', 'ends in %d months ', 'and 1 month', 'and %d months '),
        'd' => array('ends in 1 day', 'ends in %d days', 'and 1 day', 'and %d days'),
        'h' => array('ends in 1 hour', 'ends in %d hours', 'and 1 hour', 'and %d hours'),
        'i' => array('ends in 1 minute', 'ends in %d minutes', 'and 1 minute', 'and %d minutes'),
        's' => array('to day', 'ends in %d seconds', 'and 1 second', 'and %d seconds'),
    );
    protected $datetime;

    public function __construct($datetime) {
        $this->datetime = $datetime;
    }

    /**
     * Returns the difference from the current time in the format X time ago
     * @return string
     */
    public function __toString() {
        $now = new \DateTime('now');
        $diff = $this->datetime->diff($now);

        $first = false;
        $text = "";
        foreach ($this->strings as $key => $value) {
            if ($first) {
                return $text . " " . $this->getDiffText($key, $diff, true);
            }
            if (($text = $this->getDiffText($key, $diff))) {
                $first = true;
            }
        }
        return $text;
    }

    /**
     * Try to construct the time diff text with the specified interval key
     * @param string $intervalKey A value of: [y,m,d,h,i,s]
     * @param DateInterval $diff
     * @param $append
     * @return string|null
     */
    protected function getDiffText($intervalKey, $diff, $append = false) {
        $pluralKey = (!$append) ? 1 : 3;
        $value = $diff->$intervalKey;
        if ($value > 0) {
            if ($value < 2) {
                $pluralKey = (!$append) ? 0 : 2;
            }
            return sprintf($this->strings[$intervalKey][$pluralKey], $value);
        }
        return "";
    }

}