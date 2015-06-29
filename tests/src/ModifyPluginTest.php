<?php

namespace CL\Swiftmailer\Test;

use PHPUnit_Framework_TestCase;
use Swift_Mailer;
use Swift_Message;
use Swift_NullTransport;
use Swift_Plugins_MessageLogger;
use CL\Swiftmailer\ModifyPlugin;

/**
 * @coversDefaultClass CL\Swiftmailer\ModifyPlugin
 */
class ModifyPluginTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers ::beforeSendPerformed
     * @covers ::sendPerformed
     * @covers ::__construct
     */
    public function testTest()
    {
        $modifyPlugin = new ModifyPlugin(function(Swift_Message $message) {
            $message->setSubject('[modified] '.$message->getSubject());
        });

        $message = Swift_Message::newInstance();

        $message->setSubject('My subject');

        $sendEvent = $this->createSendEvent($message);

        $modifyPlugin->beforeSendPerformed($sendEvent);

        $this->assertEquals('[modified] My subject', $message->getSubject());
    }

    private function createSendEvent($message)
    {
        $event = $this->getMockBuilder('Swift_Events_SendEvent')
            ->disableOriginalConstructor()
            ->getMock();

        $event->expects($this->any())
            ->method('getMessage')
            ->will($this->returnValue($message));

        return $event;
    }
}
