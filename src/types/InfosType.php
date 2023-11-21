<?php

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class InfosType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Infos',
            'fields' => [
                'count' => Type::int(),
                'pages' => Type::int(),
                'nextPage' => Type::int(),
                'previousPage' => Type::int(),
            ],
        ]);
    }
}