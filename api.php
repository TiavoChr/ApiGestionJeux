<?php


declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

// Incluez les classes nécessaires
require_once __DIR__ . '/src/database/baseDeDonnee.php';
require_once __DIR__ . '/src/Repositories/GameRepository.php';
require_once __DIR__ . '/src/Repositories/EditorRepository.php';
require_once __DIR__ . '/src/Repositories/StudioRepository.php';
// require_once __DIR__ . '/src/Types/GameType2.php';
require_once __DIR__ . '/src/Types/GameType.php';
require_once __DIR__ . '/src/Types/EditorType.php';
// require_once __DIR__ . '/src/Types/EditorType2.php';
require_once __DIR__ . '/src/Types/StudioType.php';
require_once __DIR__ . '/src/Types/InfosType.php';
require_once __DIR__ . '/src/Types/GamesType.php';
require_once __DIR__ . '/src/Types/EditorsType.php';

use GraphQL\Server\StandardServer;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;

$db = new Database();

$gameRepository = new GameRepository($db);

$editorRepository = new EditorRepository($db);

$studioRepository = new StudioRepository($db);

$gameType = new ObjectType([
    'name' => 'Game',
    'fields' => [
        'id' => Type::id(),
        'name' => Type::nonNull(Type::string()),
        'genres' => Type::nonNull(Type::listOf(Type::nonNull(Type::string()))),
        'publicationDate' => Type::int(),
    ],
]);
$studioType = new ObjectType([
    'name' => 'Studio',
    'fields' => [
        'id' => Type::id(),
        'name' => Type::nonNull(Type::string()),
        'games' => [
            'type' => Type::listOf($gameType),
            'resolve' => function ($studio) use ($studioRepository) {
                return $studioRepository->getGamesByStudioId($studio['id']);
            },
        ],
    ],
]);

$editorType = new ObjectType([
    'name' => 'Editor',
    'fields' => [
        'id' => Type::id(),
        'name' => Type::nonNull(Type::string()),
        'games' => [
            'type' => Type::listOf(Type::nonNull($gameType)),
            'resolve' => function ($editor) use ($editorRepository) {
                return $editorRepository->getGamesByEditorId($editor['id']);
            },
        ],
    ],
]);


$queryType = new ObjectType([
    'name' => 'Query',
    'fields' => [
        'game' => [
            'type' => $gameType,
            'args' => [
                'id' => Type::nonNull(Type::id()),
            ],
            'resolve' => function ($rootValue, $args) use ($gameRepository) {
                return $gameRepository->getGameById($args['id']);
            },
        ],
        'games' => [
            'type' => Type::listOf(Type::nonNull($gameType)),
            'args' => [
                'page' => Type::int(),
                'genre' => Type::string(),
                'platform' => Type::string(),
                'studio' => Type::string(),
            ],
            'resolve' => function ($rootValue, $args, $games) use ($gameRepository) {
                return $gameRepository->getGamesInfo($args['page'], $args['genre'], $args['platform'], $args['studio']);
            },
        ],
        'editor' => [
            'type' => $editorType,
            'args' => [
                'id' => Type::nonNull(Type::id()),
            ],
            'resolve' => function ($rootValue, $args) use ($editorRepository) {
                return $editorRepository->getEditorById($args['id']);
            },
        ],
        'studio' => [
            'type' => $studioType,
            'args' => [
                'id' => Type::nonNull(Type::id()),
            ],
            'resolve' => function ($rootValue, $args) use ($studioRepository) {
                return $studioRepository->getStudioById($args['id']);
            },
        ],
    ],
]);

$schema = new Schema(
    [
        'query' => $queryType,
    ]
);

$server = new StandardServer([
    'schema' => $schema,
]);

$server->handleRequest();
?>

