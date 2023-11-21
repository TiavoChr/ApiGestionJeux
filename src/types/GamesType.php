<?php

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class GamesType extends ObjectType
{
    public function __construct(InfosType $infosType, GameType $gameType)
    {
        parent::__construct([
            'name' => 'Games',
            'fields' => [
                'infos' => [
                    'type' => Type::nonNull($infosType),
                ],
                'results' => [
                    'type' => Type::listOf($gameType),
                ],
            ],
        ]);
    }
}
