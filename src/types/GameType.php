<?php

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class GameType extends ObjectType
{
    public function __construct(GameRepository $gameRepository, EditorRepository $editorRepository, StudioRepository $studioRepository)
    {

        parent::__construct([
            'name' => 'Game',
            'fields' => [
                'id' => Type::id(),
                'name' => Type::nonNull(Type::string()),
                'genres' => Type::listOf(Type::nonNull(Type::string())),
                'publicationDate' => Type::int(),
                'editors' => [
                    'type' => Type::listOf(Type::nonNull(new EditorType($editorRepository, $gameRepository, $studioRepository))),
                    'resolve' => function ($game) use ($editorRepository) {
                        return $editorRepository->getEditorsByGameId($game['id']);
                    },
                ],
                'studios' => [
                    'type' => Type::listOf(Type::nonNull(new StudioType($studioRepository, $gameRepository, $editorRepository))),
                    'resolve' => function ($game) use ($studioRepository) {
                        return $studioRepository->getStudiosByGameId($game['id']);
                    },
                ],
                'platform' => Type::nonNull(Type::string()),
            ],
        ]);
    }
}
