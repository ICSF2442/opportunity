<?php


namespace Enumerators;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;


enum Role: int
{
    case TOP = 1;
    case JUNGLE = 2;
    case MID = 3;
    case BOT = 4;
    case SUP = 5;

    public function name(): string
    {
        return match ($this) {
            self::TOP => 'Toplaner',
            self::JUNGLE => 'Jungler',
            self::MID => 'Midlaner',
            self::BOT => 'Botlaner',
            self::SUP => 'Support',
        };
    }

    public static function getAllItems(): array
    {
        return array(
            self::TOP,
            self::JUNGLE,
            self::MID,
            self::BOT,
            self::SUP,
        );
    }

    #[Pure]
    #[ArrayShape(["name" => "string", "value" => "\Role"])]
    public function toArray(): array
    {
        return array(
            "name" => $this::name(),
            "value" => $this->value
        );
    }

    public static function getItem(?int $num): ?Role
    {
        return match ($num) {
            1 => self::TOP,
            2 => self::JUNGLE,
            3 => self::MID,
            4 => self::BOT,
            5 => self::SUP,
            default => null,
        };
    }

    #[Pure]
    public static function getItemByName(?string $str): ?Role
    {
        return match ($str) {
            self::TOP->name() => self::TOP,
            self::JUNGLE->name() => self::JUNGLE,
            self::MID->name() => self::MID,
            self::BOT->name()=> self::BOT,
            self::SUP->name()=> self::SUP,
            default => null,
        };
    }
}
