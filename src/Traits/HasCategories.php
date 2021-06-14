<?php

namespace Nickfairchild\NovaBlog\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Nickfairchild\NovaBlog\Models\Category;

trait HasCategories
{
    public function categories()
    {
        return $this->morphToMany(
            config('nova-blog.models.category'),
            'model',
            config('nova-blog.table_names.model_has_categories'),
            'model_id',
            'category_id'
        );
    }

    public function scopeCategory(Builder $query, $categories): Builder
    {
        $categories = $this->convertToCategoriesModels($categories);

        return $query->where(function (Builder $query) use ($categories) {
            $query->whereHas('categories', function (Builder $subQuery) use ($categories) {
                $subQuery->whereIn(config('nova-blog.table_names.categories').'.id', \array_column($categories, 'id'));
            });
        });
    }

    protected function convertToCategoriesModels($categories): array
    {
        if ($categories instanceof Collection) {
            $categories = $categories->all();
        }

        $categories = is_array($categories) ? $categories : [$categories];

        return array_map(function ($category) {
            if ($category instanceof Category) {
                return $category;
            }

            return $this->getCategoryClass()->findByName($category);
        }, $categories);
    }

    protected function getCategoryClass()
    {
        $class = config('nova-blog.models.category');

        return new $class;
    }
}
