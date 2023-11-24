<?php

require_once __DIR__ . '/vendor/autoload.php';

use GraphQL\Server\StandardServer;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;

// Incluez les classes nécessaires
require_once __DIR__ . '/src/database/baseDeDonnee.php';
require_once __DIR__ . '/src/Repositories/GameRepository.php';
require_once __DIR__ . '/src/Repositories/EditorRepository.php';
require_once __DIR__ . '/src/Repositories/StudioRepository.php';
require_once __DIR__ . '/src/Types/GameType.php';
require_once __DIR__ . '/src/Types/EditorType.php';
require_once __DIR__ . '/src/Types/StudioType.php';
require_once __DIR__ . '/src/Types/StudiosType.php';
require_once __DIR__ . '/src/Types/InfosType.php';
require_once __DIR__ . '/src/Types/GamesType.php';
require_once __DIR__ . '/src/Types/EditorsType.php';

$db = new Database();

$gameRepository = new GameRepository($db);

$editorRepository = new EditorRepository($db);

$studioRepository = new StudioRepository($db);

// var_dump($gameRepository->getGames());
// var_dump($editorRepository->getEditors());
// var_dump($studioRepository->getStudios());
// $db = new Database();

// $sql = "SELECT * FROM game_editors ";
// $stmt = $db->executeQuery($sql);
// var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));

// $sql2 = "SELECT * FROM game_studios ";
// $stmt2 = $db->executeQuery($sql2);
// var_dump($stmt2->fetchAll(PDO::FETCH_ASSOC));

$gameType = new GameType($gameRepository);

$editorType = new EditorType($editorRepository);

$studioType = new StudioType($studioRepository);

// Type d'objet pour les informations de pagination
$infosType = new InfosType();

// Type d'objet pour la liste de jeux
$gamesType = new GamesType($infosType, $gameType);

// Type d'objet pour la liste d'éditeurs
$editorsType = new EditorsType($infosType, $editorType);

$studiosType = new StudiosType($infosType, $studioType);

// Définition du schéma
$queryType = new ObjectType([
    'name' => 'Query',
    'fields' => [
        'games' => [
            'type' => $gamesType,
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
        'game' => [
            'type' => $gameType,
            'args' => [
                'id' => Type::nonNull(Type::id()),
            ],
            'resolve' => function ($rootValue, $args) use ($gameRepository) {
                return $gameRepository->getGameById($args['id']);
            },
        ],
        'editors' => [
            'type' => $editorsType,
            'args' => [
                'page' => Type::int(),
            ],
            'resolve' => function ($rootValue) use ($editorRepository) {
                return $editorRepository->getEditors();
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
        'studios' => [
            'type' => $studiosType,
            'args' => [
                'page' => Type::int(),
            ],
            'resolve' => function ($rootValue) use ($studioRepository) {
                return $studioRepository->getStudios();
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