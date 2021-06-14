<?php

namespace Nickfairchild\NovaBlog\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public static function findByName(string $name)
    {
        $category = static::getCategories(['name' => $name])->first();

        return $category;
    }

    public static function getCategories(array $params = [])
    {
        foreach ($params as $attr => $value) {
            $categories = static::query()->where($attr, $value);
        }

        return $categories;
    }
}
