<?php

namespace App\Services\Admin;

use App\Models\Menu;
use App\Enums\ModuleEnum;
use Illuminate\Http\Request;
use App\Models\MenuTranslate;
use Illuminate\Database\Eloquent\Model;

class MenuService extends BaseService
{
    protected $menu;

    public function __construct(Menu $menu)
    {
        parent::__construct($menu, ModuleEnum::Menu);
    }

    public function create(Object $request)
    {
        $data = new Request([
            "url" => $request->urlSelect ?? $request->url,
            "type" => $request->type,
            "parent_id" => $request->parent_id ?? 0,
            "order" => $request->order,
            "blank" => $request->blank ?? false,
        ]);

        $query = parent::create($data);

        if ($query->id) {
            $this->translations($query->id, $request);
        }

        return $query;
    }

    public function update(Object $request, Model $menu)
    {
        $data = new Request([
            "url" => $request->urlSelect ?? $request->url,
            "type" => $request->type,
            "parent_id" => $request->parent_id ?? 0,
            "order" => $request->order,
            "blank" => $request->blank ?? false,
        ]);

        $query = parent::update($data, $menu);

        if ($query) {
            $this->translations($menu->id, $request);
        }

        return $query;
    }

    public function delete(Model $menu)
    {
        $query = parent::delete($menu);

        if ($query) {
            Menu::whereParentId($menu->id)->delete();
        }
        return $query;
    }

    public function translations(int $pageId, Object $request)
    {
        $languages = languageList();
        foreach ($languages as $language) {
            if (!empty($request->title[$language->code])) {
                MenuTranslate::updateOrCreate(
                    [
                        "menu_id" => $pageId,
                        "lang" => $language->code
                    ],
                    [
                        "title" => $request->title[$language->code] ?? null,
                    ]
                );
            }
        }
    }

    public function getUrlList(): array
    {
        return [
            route("home") => __("front/home.page_title"),
            route(ModuleEnum::Blog->Route() . ".index") => ModuleEnum::Blog->singleTitle(),
            route(ModuleEnum::Service->Route() . ".index") => ModuleEnum::Service->singleTitle(),
            route(ModuleEnum::Product->Route() . ".index") => ModuleEnum::Product->singleTitle(),
            route(ModuleEnum::Project->Route() . ".index") => ModuleEnum::Project->singleTitle(),
            // route(ModuleEnum::Reference->Route() . ".index") => ModuleEnum::Reference->singleTitle(),
            route("contact.index") => __("front/contact.page_title"),
        ];
    }
}
