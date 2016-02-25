<?php

namespace TwitterBis\Formatter;


class MessageTimeFormatter
{

    public function format(\DateTime $time)
    {
        $currentTime = new \DateTime('now', new \DateTimeZone('Europe/Madrid'));
        /** @var \DateInterval $diff */
        $diff = $currentTime->diff($time, true);

        if ($diff->y) {
            return sprintf('%d years ago', $diff->y);
        }
        if ($diff->m) {
            return sprintf('%d months ago', $diff->m);
        }
        if ($diff->d) {
            return sprintf('%d days ago', $diff->d);
        }
        if ($diff->h) {
            return sprintf('%d hours ago', $diff->h);
        }
        if ($diff->i) {
            return sprintf('%d minutes ago', $diff->i);
        }
        return '';
    }
}