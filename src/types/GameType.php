<?php

require_once 'EditorTypeMini.php';
require_once 'StudioTypeMini.php';

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class GameType extends ObjectType
{
    public function __construct(GameRepository $gameRepository)
    {

        parent::__construct([
            'name' => 'Game',
            'fields' => [
                'id' => Type::id(),
                'name' => Type::nonNull(Type::string()),
                'genres' => Type::listOf(Type::nonNull(Type::string())),
                'publicationDate' => Type::int(),
                'editors' => [
                    'type' => Type::listOf(Type::nonNull(new EditorTypeMini())),
                    'resolve' => function ($game) use ($gameRepository) {
                        return $gameRepository->getEditorsByGameId($game['id']);
                    },
                ],
                'studios' => [
                    'type' => Type::listOf(Type::nonNull(new StudioTypeMini())),
                    'resolve' => function ($game) use ($gameRepository) {
                        return $gameRepository->getStudiosByGameId($game['id']);
                    },
                ],
                'platform' => Type::nonNull(Type::string()),
            ],
        ]);
    }
}
