<?php
namespace Fei\Service\Notification\Tests\Entity;

use Fei\Service\Notification\Entity\Alert;
use Fei\Service\Notification\Entity\Alert\Rss;
use PHPUnit\Framework\TestCase;

class RssTest extends TestCase
{
    public function testRssAccessors()
    {
        $alert = new Rss();
        $alert->setRecipient("toto");

        $this->assertEquals("toto", $alert->getRecipient());
        $this->assertAttributeEquals($alert->getRecipient(), 'recipient', $alert);
    }

    public function testContentAccessors()
    {
        $alert = new Rss();
        $alert->setContent("fake-content");

        $this->assertEquals("fake-content", $alert->getContent());
        $this->assertAttributeEquals($alert->getContent(), 'content', $alert);
    }

    public function testSubjectAccessors()
    {
        $alert = new Rss();
        $alert->setSubject("fake-subject");

        $this->assertEquals("fake-subject", $alert->getSubject());
        $this->assertAttributeEquals($alert->getSubject(), 'subject', $alert);
    }

    public function testGetType()
    {
        $alert = new Rss();

        $this->assertEquals(Alert::ALERT_RSS, $alert->getType());
    }
}
