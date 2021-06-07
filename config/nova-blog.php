<?php

return [

    'models' => [

        'post' => \Nickfairchild\NovaBlog\Models\Post::class,

        'category' => \Nickfairchild\NovaBlog\Models\Category::class,

    ],

    'table_names' => [

        'posts' => 'posts',

        'categories' => 'categories',

        'model_has_categories' => 'model_has_categories',

    ],

    'resources' => [

        \Nickfairchild\NovaBlog\Nova\Resources\Post::class,
        \Nickfairchild\NovaBlog\Nova\Resources\Category::class,

    ],

    'render-navigation' => true,

];
