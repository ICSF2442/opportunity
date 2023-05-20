<?php
namespace Enumerators;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;


enum Status: int
{
    case ACTIVE = 1;
    case INACTIVE = 2;
    case RETIRED = 3;
    public function name(): string
    {
        return match ($this) {
            self::ACTIVE => 'Ativo',
            self::INACTIVE => 'Inativo',
            self::RETIRED => 'Reformado',
        };
    }

    public static function getAllItems(): array{
        return array(
            self::ACTIVE,
            self::INACTIVE,
            self::RETIRED,
        );
    }

    #[Pure]
    #[ArrayShape(["name" => "string", "value" => "\Status"])]
    public function toArray() : array
    {
        return array(
            "name" => $this::name(),
            "value" => $this->value
        );
    }

    public static function getItem(?int $num) : ?Status {
        return match ($num) {
            1 => self::ACTIVE,
            2 => self::INACTIVE,
            3 => self::RETIRED,
            default => null,
        };
    }

    #[Pure]
    public static function getItemByName(?String $str) : ?Status {
        return match ($str) {
            self::ACTIVE->name() => self::ACTIVE,
            self::INACTIVE->name() => self::INACTIVE,
            self::RETIRED->name() => self::RETIRED,
            default => null,
        };
    }
}
