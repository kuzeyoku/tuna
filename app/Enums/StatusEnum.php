<?php

namespace App\Enums;

use Exception;

enum StatusEnum: string
{
    case Active = "active";
    case Passive = "passive";
    case Draft = "draft";
    case Pending = "pending";
    case Read = "read";
    case Unread = "unread";
    case Answered = "answered";
    case Yes = "yes";
    case No = "no";

    public function title(): string
    {
        return __("admin/status." . $this->value);
    }

    public function color(): string
    {
        return match ($this) {
            self::Active => "lightgreen",
            self::Passive => "lightred",
            self::Draft => "lightgrey",
            self::Pending => "lightyellow",
            self::Read => "lightgreen",
            self::Unread => "lightyellow",
            self::Answered => "lightgrey",
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Active => "check",
            self::Passive => "ban",
            self::Draft => "edit",
            self::Pending => "clock",
        };
    }

    public function badge(): string
    {
        return sprintf('<span class="badges bg-%s">%s</span>', $this->color(), $this->title());
    }

    public static function getValues()
    {
        return [
            StatusEnum::Active->value,
            StatusEnum::Passive->value,
            StatusEnum::Draft->value,
            StatusEnum::Pending->value,
        ];
    }

    public static function getStatus($value)
    {
        $statusList = [
            'active' => StatusEnum::Active,
            'passive' => StatusEnum::Passive,
            'draft' => StatusEnum::Draft,
            'pending' => StatusEnum::Pending,
            'read' => StatusEnum::Read,
            'unread' => StatusEnum::Unread,
            'answered' => StatusEnum::Answered,
        ];

        if (array_key_exists($value, $statusList)) {
            return $statusList[$value];
        }

        throw new Exception(__("admin/general.invalid_value"));
    }

    public static function toSelectArray()
    {
        return [
            StatusEnum::Active->value => StatusEnum::Active->title(),
            StatusEnum::Passive->value => StatusEnum::Passive->title(),
            StatusEnum::Draft->value => StatusEnum::Draft->title(),
            StatusEnum::Pending->value => StatusEnum::Pending->title(),
        ];
    }

    public static function getOnOffSelectArray()
    {
        return [
            StatusEnum::Passive->value => StatusEnum::Passive->title(),
            StatusEnum::Active->value => StatusEnum::Active->title(),
        ];
    }

    public static function getTrueFalseSelectArray()
    {
        return [
            false => StatusEnum::No->title(),
            true => StatusEnum::Yes->title(),
        ];
    }

    public static function getYesNoSelectArray()
    {
        return [
            StatusEnum::No->value => StatusEnum::No->title(),
            StatusEnum::Yes->value => StatusEnum::Yes->title(),
        ];
    }
}
