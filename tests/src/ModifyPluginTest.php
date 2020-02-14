<?php

namespace CL\Swiftmailer\Test;

use PHPUnit\Framework\TestCase;
use Swift_Message;
use CL\Swiftmailer\ModifyPlugin;

/**
 * @coversDefaultClass \CL\Swiftmailer\ModifyPlugin
 */
class ModifyPluginTest extends TestCase
{
    /**
     * @covers ::beforeSendPerformed
     * @covers ::sendPerformed
     * @covers ::__construct
     */
    public function testEvents()
    {
        $modifyPlugin = new ModifyPlugin(function(Swift_Message $message) {
            $message->setSubject('[modified] '.$message->getSubject());
        });

        $message = Swift_Message::newInstance();

        $message->setSubject('My subject');

        $sendEvent = $this->createSendEvent($message);

        $modifyPlugin->beforeSendPerformed($sendEvent);

        $this->assertEquals('[modified] My subject', $message->getSubject());

        $modifyPlugin->sendPerformed($sendEvent);
    }

    /**
     * @covers ::getModifier
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $modifier = [$this, 'createSendEvent'];

        $modifyPlugin = new ModifyPlugin($modifier);

        $this->assertSame($modifier, $modifyPlugin->getModifier());
    }

    public function createSendEvent($message)
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
