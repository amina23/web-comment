<?php

namespace App\Lib;
use Symfony\Component\Uid\Uuid as BaseUuid;

class Uuid
{
    private $value;

    private  function __construct()
    {
        $this->value = BaseUuid::v6();
    }

    public static function new(): string
    {
        return (new self())->toString();
    }

    public function toString(): string
    {
        return $this->value->toRfc4122();
    }
}
