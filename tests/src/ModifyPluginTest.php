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
class InitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers ::beforeSendPerformed
     * @covers ::sendPerformed
     * @covers ::__construct
     */
    public function testTest()
    {
        $mailer = Swift_Mailer::newInstance(Swift_NullTransport::newInstance());

        $mailer->registerPLugin(new ModifyPlugin(function(Swift_Message $message) {
            $message->setSubject('[test] '.$message->getSubject());
        }));

        $logger = new Swift_Plugins_MessageLogger();

        $mailer->registerPLugin($logger);

        $message = Swift_Message::newInstance();

        $message
            ->setSubject('My subject')
            ->setBody('body')
            ->setTo('other@example.com')
            ->setFrom('me@example.com');

        $mailer->send($message);

        $sent = $logger->getMessages();

        $rendered = (string) $sent[0];

        $expected = "Subject: [test] My subject\r\nFrom: me@example.com\r\nTo: other@example.com\r\nMIME-Version: 1.0\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\nbody";

        $this->assertContains($expected, $rendered);
    }
}
