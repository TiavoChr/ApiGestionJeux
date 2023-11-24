<?php

require_once 'GameTypeMini.php';
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class EditorType extends ObjectType
{
    
    public function __construct(EditorRepository $editorRepository)
    {
        parent::__construct([
            'name' => 'Editor',
            'fields' => [
                'id' => Type::id(),
                'name' => Type::nonNull(Type::string()),
                'games' => [
                    'type' => Type::listOf(Type::nonNull(new GameTypeMini())),
                    'resolve' => function ($editor) use ($editorRepository) {
                        return $editorRepository->getGamesByEditorId($editor['id']);
                    },
                ],
            ],
        ]);
    }

    
}
