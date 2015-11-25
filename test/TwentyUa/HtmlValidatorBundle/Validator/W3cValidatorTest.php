<?php


class W3cValidatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Buzz\Browser
     */
    private $browser;

    /**
     * @var \TwentyUa\HtmlValidatorBundle\Validator\W3cValidator
     */
    private $validator;

    protected function setUp()
    {
        $this->browser = $this->getMock('Buzz\Browser');
        $this->validator = new \TwentyUa\HtmlValidatorBundle\Validator\W3cValidator($this->browser);
    }

    public function testMarkupValid()
    {
        $content = '{"messages":[{"type":"info","message":"The Content-Type was “text/html”. Using the HTML parser."}]}';

        $response = $this->getMock('Buzz\Message\MessageInterface');
        $response->expects($this->once())
            ->method("getContent")
            ->will($this->returnValue($content));

        $this->browser->expects($this->once())
            ->method("post")
            ->will($this->returnValue($response));

        $this->assertTrue($this->validator->isMarkupValid("<!DOCTYPE html><html><head><title>title</title></head><body></body></html>"));
    }

    public function testMarkupInValid()
    {
        $content = '{"messages":[{"type":"info","message":"The Content-Type was “text/html”. Using the HTML parser."},{"type":"info","message":"Using the schema for HTML with SVG 1.1, MathML 3.0, RDFa 1.1, and ITS 2.0 support."},{"type":"error","lastLine":1,"lastColumn":42,"firstColumn":35,"message":"Element “title” must not be empty.","extract":"ad><title></title></head","hiliteStart":10,"hiliteLength":8}]}';

        $response = $this->getMock('Buzz\Message\MessageInterface');

        $response->expects($this->once())
            ->method("getContent")
            ->will($this->returnValue($content));

        $this->browser->expects($this->once())
            ->method("post")
            ->will($this->returnValue($response));

        $this->assertFalse($this->validator->isMarkupValid("<!DOCTYPE html><html><head><title></title></head><body></body></html>"));
    }
}