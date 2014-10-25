<?php
/**
 * This file is part of the validator.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Validator\Message;

/**
 * Class StringMessageTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\Validator\Message
 *
 * @covers Star\Component\Validator\Message\StringMessage
 */
class StringMessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StringMessage
     */
    private $message;

    public function setUp()
    {
        $this->message = new StringMessage('my-message');
    }

    public function test_it_should_return_the_string_message()
    {
        $this->assertSame('my-message', $this->message->getString());
    }
}
 