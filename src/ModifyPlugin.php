<?php

namespace CL\Swiftmailer;

use Swift_Events_SendListener;
use Closure;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2015, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class ModifyPlugin implements Swift_Events_SendListener
{
    private $modifier;

    function __construct(Closure $modifier)
    {
        $this->modifier = $modifier;
    }

    /**
     * Apply whitelist and blacklist to "to", "cc" and "bcc"
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function beforeSendPerformed(\Swift_Events_SendEvent $evt)
    {
        $message = $evt->getMessage();

        $modifier = $this->modifier;

        $modifier($message);
    }

    /**
     * Do nothing
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function sendPerformed(\Swift_Events_SendEvent $evt)
    {
        // Do Nothing
    }
}
