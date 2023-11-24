<?php

require_once 'GameTypeMini.php';
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class StudioType extends ObjectType
{
    public function __construct(StudioRepository $studioRepository)
    {
        parent::__construct([
            'name' => 'Studio',
            'fields' => [
                'id' => Type::id(),
                'name' => Type::nonNull(Type::string()),
                'games' => [
                    'type' => Type::listOf(Type::nonNull(new GameTypeMini())),
                    'resolve' => function ($studio) use ($studioRepository) {
                        return $studioRepository->getGamesByStudioId($studio['id']);
                    },
                ],
            ],
        ]);
    }

}
