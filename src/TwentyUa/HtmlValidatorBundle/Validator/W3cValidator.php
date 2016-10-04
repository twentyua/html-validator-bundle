<?php


namespace TwentyUa\HtmlValidatorBundle\Validator;


use Buzz\Browser;

class W3cValidator implements ValidatorInterface
{
    /**
     * @var Browser
     */
    private $browser;

    /**
     * W3cValidator constructor.
     * @param Browser $browser
     */
    public function __construct(Browser $browser = null)
    {
        if (null === $browser) {
            $browser = new Browser();
        }
        $this->browser = $browser;
    }


    public function isMarkupValid($content)
    {
        $response = $this->browser->post('https://validator.w3.org/nu/?out=json', [
            'Content-Type' => 'text/html',
            'User-Agent'   => 'w3c api',
        ], $content);

        $data = json_decode($response->getContent());

        $errors = array_filter($data->messages, function ($message) {
            return $message->type === 'error';
        });

        return count($errors) == 0;
    }
}