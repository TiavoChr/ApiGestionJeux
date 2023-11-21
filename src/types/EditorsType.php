<?php

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class EditorsType extends ObjectType
{
    public function __construct(InfosType $infosType, EditorType $editorType)
    {
        parent::__construct([
            'name' => 'Editors',
            'fields' => [
                'infos' => [
                    'type' => Type::nonNull($infosType),
                ],
                'results' => [
                    'type' => Type::listOf($editorType),
                ],
            ],
        ]);
    }
}
