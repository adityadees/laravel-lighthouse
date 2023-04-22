<?php

declare(strict_types=1);

namespace AdityaDees\LaravelLighthouse\Exceptions;

use Exception;

class ErrorException extends Exception
{

    public static function device(string $device): self
    {
        return new self("Option Device `{$device}` Not Found. Please define the device as mobile or desktop, or you can let it blank to run both");
    }

    public static function pathOutput(): self
    {
        return new self("Output Path Not found, please define it on on config/larave-lighthouse.php");
    }

    public static function pathNode(): self
    {
        return new self("Node Path Not found, please define it on on config/larave-lighthouse.php");
    }

    public static function pathLighthouse(): self
    {
        return new self("Lighthouse Path Not found, please define it on on config/larave-lighthouse.php");
    }

    public static function url(): self
    {
        return new self("Url not define, please define it as global on config, or defined is as parameter");
    }

    public static function host(): self
    {
        return new self("Host Not found, please use valid url example : https://example.com or https://example.com/blog");
    }
}
