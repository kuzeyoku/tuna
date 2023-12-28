<?php

namespace App\Enums;

enum SettingCategoryEnum: string
{
    case General = "general";
    case Pagination = "pagination";
    case Information = "information";
    case Social = "social";
    case Caching = "caching";
    case Contact = "contact";
    case Smtp = "smtp";
    case Maintenance = "maintenance";
    case Image = "image";
    case Sitemap = "sitemap";
    case Recaptcha = "recaptcha";
    case Logo = "logo";

    public function title(): string
    {
        return __("admin/setting.category_" . $this->value);
    }

    public function status(): Bool
    {
        return match ($this) {
            self::General => true,
            self::Pagination => true,
            self::Information => true,
            self::Social => true,
            self::Caching => true,
            self::Contact => true,
            self::Smtp => true,
            self::Maintenance => false,
            self::Image => true,
            self::Sitemap => true,
            self::Recaptcha => true,
            self::Logo => false,
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::General => "fas-cog",
            self::Pagination => "fas-map-signs",
            self::Information => "fas-info-circle",
            self::Social => "fas-share-alt",
            self::Caching => "fas-sync",
            self::Contact => "fas-address-book",
            self::Smtp => "fas-envelope-open-text",
            self::Maintenance => "fas-tools",
            self::Image => "fas-image",
            self::Sitemap => "fas-sitemap",
            self::Recaptcha => "fas-shield-alt",
            self::Logo => "fas-image",
        };
    }


    public static function getValues(): array
    {
        return array_map(fn ($value) => $value->value, self::cases());
    }

    public function existsViewFile(): bool
    {
        return view()->exists("admin.setting." . $this->value);
    }
}
