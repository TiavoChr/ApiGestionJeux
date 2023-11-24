<?php

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class GameTypeMini extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Game',
            'fields' => [
                'id' => Type::id(),
                'name' => Type::nonNull(Type::string()),
                'genres' => Type::listOf(Type::nonNull(Type::string())),
                'publicationDate' => Type::int(),
                'platform' => Type::nonNull(Type::string()),
            ],
        ]);
    }
}
