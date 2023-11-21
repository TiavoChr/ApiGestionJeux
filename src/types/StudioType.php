<?php

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class StudioType extends ObjectType
{
    public function __construct(StudioRepository $studioRepository, GameRepository $gameRepository, EditorRepository $editorRepository)
    {
        parent::__construct([
            'name' => 'Studio',
            'fields' => [
                'id' => Type::id(),
                'name' => Type::nonNull(Type::string()),
                'games' => [
                    'type' => Type::listOf(Type::nonNull(new GameType($gameRepository, $editorRepository, $studioRepository))),
                    'resolve' => function ($studio) use ($gameRepository) {
                        return $gameRepository->getGamesByStudioId($studio['id']);
                    },
                ],
            ],
        ]);
    }

}
