<?php

namespace Just2\FrontendBundle\Twig\Extension;

use Twig_Extension;
use Twig_Filter_Method;
use Twig_Function_Method;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToTimestampTransformer;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Constraints\DateTime;

class utilExtension extends \Twig_Extension {
// ...

    public function getName() {
        return 'JVJ';
    }

    public function getFunctions() {
        return array(
            'estatebid' => new \Twig_Function_Method($this, 'estatebid'),
            'time_ago_in_words' => new \Twig_Function_Method($this, 'timeAgoInWordsFilter')
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

    /**
     * Like distance_of_time_in_words, but where to_time is fixed to timestamp()
     *
     * @param $from_time String or DateTime
     * @param bool $include_seconds
     *
     * @return mixed
     */

    public function timeAgoInWordsFilter($from_time) {
        return $this->distanceOfTimeInWordsFilter($from_time, new \DateTime('now'), false);
    }



    /**
     * Reports the approximate distance in time between two times given in seconds
     * or in a valid ISO string like.
     * For example, if the distance is 47 minutes, it'll return
     * "about 1 hour". See the source for the complete wording list.
     *
     * Integers are interpreted as seconds. So, by example to check the distance of time between
     * a created user an it's last login:
     * {{ user.createdAt|distance_of_time_in_words(user.lastLoginAt) }} returns "less than a minute".
     *
     * Set include_seconds to true if you want more detailed approximations if distance < 1 minute
     *
     * @param $from_time String or DateTime
     * @param $to_time String or DateTime
     * @param bool $include_seconds
     *
     * @return mixed
     */

    public function distanceOfTimeInWordsFilter($from_time, $to_time = null, $include_seconds = false) {

        $datetime_transformer = new DateTimeToStringTransformer(null, null, 'Y-m-d H:i:s');
        $timestamp_transformer = new DateTimeToTimestampTransformer();

        # Transforming to Timestamp
        if (!($from_time instanceof \DateTime) && !is_numeric($from_time)) {
            $from_time = $datetime_transformer->reverseTransform($from_time);
            $from_time = $timestamp_transformer->transform($from_time);
        } elseif ($from_time instanceof \DateTime) {
            $from_time = $timestamp_transformer->transform($from_time);
        }

        $to_time = empty($to_time) ? new \DateTime('now') : $to_time;

        # Transforming to Timestamp

        if (!($to_time instanceof \DateTime) && !is_numeric($to_time)) {
            $to_time = $datetime_transformer->reverseTransform($to_time);
            $to_time = $timestamp_transformer->transform($to_time);
        } elseif ($to_time instanceof \DateTime) {
            $to_time = $timestamp_transformer->transform($to_time);
        }

        $distance_in_minutes = round((abs($to_time - $from_time)) / 60);
        $distance_in_seconds = round(abs($to_time - $from_time));
        if ($distance_in_minutes <= 1) {
            if ($include_seconds) {
                if ($distance_in_seconds < 5) {
                    return 'less than 5 seconds ago';
                } elseif ($distance_in_seconds < 10) {
                    return 'less than 10 seconds ago';
                } elseif ($distance_in_seconds < 20) {
                    return 'less than 20 seconds ago';
                } elseif ($distance_in_seconds < 40) {
                    return 'half a minute ago';
                } elseif ($distance_in_seconds < 60) {
                    return 'less than a minute ago';
                } else {
                    return '1 minute ago';
                }
            }
            return ($distance_in_minutes===0) ? 'less than a minute ago' : '1 minute ago'; 
        } elseif ($distance_in_minutes <= 45) {
            return $distance_in_minutes . ' minutes ago';
        } elseif ($distance_in_minutes <= 90) {
            return 'about 1 hour ago';
        } elseif ($distance_in_minutes <= 1440) {
            return 'about ' . $distance_in_minutes . ' hours ago';
        } elseif ($distance_in_minutes <= 2880) {
            return '1 day ago';
        } else {
            return $distance_in_minutes / 1440 . ' days ago';
        }
    }    

}

