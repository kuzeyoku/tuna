<?php

namespace App\Services\Admin;

use App\Enums\ModuleEnum;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoryTranslate;
use Illuminate\Database\Eloquent\Model;

class CategoryService extends BaseService
{
    protected $category;

    public function __construct(Category $category)
    {
        parent::__construct($category, ModuleEnum::Category);
    }

    public function create(Object $request)
    {
        $data = new Request([
            "slug" => Str::slug($request->title[$this->defaultLocale]),
            "order" => $request->order,
            "status" => $request->status,
            "parent_id" => $request->parent,
        ]);

        if ($request->parent == 0) {
            $data = $data->merge([
                "module" => $request->module,
            ]);
        } else {
            $parent = Category::find($request->parent);
            $data = $data->merge([
                "module" => $parent->module,
            ]);
        }

        $category = parent::create($data);

        if ($category->id) {
            $this->upsertTranslations($category->id, $request);
            return true;
        }
        return false;
    }

    public function update(Object $request, $category)
    {
        $data = new Request([
            "slug" => Str::slug($request->title[$this->defaultLocale]),
            "order" => $request->order,
            "status" => $request->status,
            "parent_id" => $request->parent,
        ]);
        if ($request->parent != 0) {
            $parent = Category::find($request->parent);
            $data = $data->merge([
                "module" => $parent->module,
            ]);
        } else {
            $data = $data->merge([
                "module" => $request->module,
            ]);
        }

        $query = Parent::update($data, $category);
        if ($query) {
            $this->upsertTranslations($category->id, $request);
            return true;
        }
        return false;
    }

    protected function upsertTranslations(int $categoryId, Object $request)
    {
        $data = [];
        $filteredTitle = array_filter($request->title);
        $filteredDescription = array_filter($request->description);

        foreach (languageList() as $lang) {
            if (isset($filteredTitle[$lang->code]) || isset($filteredDescription[$lang->code])) {
                $data[] = [
                    "category_id" => $categoryId,
                    "lang" => $lang->code,
                    "title" => $request->title[$lang->code] ?? null,
                    "description" => $request->description[$lang->code] ?? null
                ];
            }
        }

        if (!empty($data)) {
            CategoryTranslate::upsert($data, ["category_id", "lang"]);
        }
    }

    public function delete(Model $category)
    {
        Category::where("parent_id", $category->id)->delete();
        return parent::delete($category);
    }
}
