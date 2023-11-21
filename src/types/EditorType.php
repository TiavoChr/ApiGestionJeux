<?php

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class EditorType extends ObjectType
{
    
    public function __construct(EditorRepository $editorRepository, GameRepository $gameRepository, StudioRepository $studioRepository)
    {
        parent::__construct([
            'name' => 'Editor',
            'fields' => [
                'id' => Type::id(),
                'name' => Type::nonNull(Type::string()),
                'games' => [
                    'type' => Type::listOf(Type::nonNull(new GameType($gameRepository, $editorRepository, $studioRepository))),
                    'resolve' => function ($editor) use ($gameRepository) {
                        return $gameRepository->getGamesByEditorId($editor['id']);
                    },
                ],
            ],
        ]);
    }

    
}
