<?php

class AppdRatchetException extends \Exception
{
    static function ensure($expression, $failMsg = "")
    {
        if (!$expression) {
            throw new self($failMsg);
        }
    }
}
