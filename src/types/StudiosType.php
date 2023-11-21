<?php

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class StudiosType extends ObjectType
{
    public function __construct(InfosType $infosType, StudioType $StudioType)
    {
        parent::__construct([
            'name' => 'Editors',
            'fields' => [
                'infos' => [
                    'type' => Type::nonNull($infosType),
                ],
                'results' => [
                    'type' => Type::listOf($StudioType),
                ],
            ],
        ]);
    }
}
