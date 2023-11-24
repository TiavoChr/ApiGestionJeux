<?php

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class StudioTypeMini extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Studio',
            'fields' => [
                'id' => Type::id(),
                'name' => Type::nonNull(Type::string()),
            ],
        ]);
    }

}
