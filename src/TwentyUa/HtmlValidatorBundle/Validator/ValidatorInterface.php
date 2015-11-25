<?php


namespace TwentyUa\HtmlValidatorBundle\Validator;


interface ValidatorInterface
{
    /**
     * @param string $content
     * @return boolean true if markup is valid
     */
    public function isMarkupValid($content);
}