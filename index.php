<?php

require_once __DIR__ . '/vendor/autoload.php';

use GraphQL\Type\Schema;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\GraphQL;

// Incluez les classes nécessaires
require_once __DIR__ . '/src/database/baseDeDonnee.php';
require_once __DIR__ . '/src/Repositories/GameRepository.php';
require_once __DIR__ . '/src/Repositories/EditorRepository.php';
require_once __DIR__ . '/src/Repositories/StudioRepository.php';
require_once __DIR__ . '/src/Types/GameType.php';
require_once __DIR__ . '/src/Types/EditorType.php';
require_once __DIR__ . '/src/Types/StudioType.php';
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

$gameType = new GameType($gameRepository, $editorRepository, $studioRepository);

$editorType = new EditorType($editorRepository, $gameRepository, $studioRepository);

$studioType = new StudioType($studioRepository, $gameRepository, $editorRepository);

// Type d'objet pour les informations de pagination
$infosType = new InfosType();

// Type d'objet pour la liste de jeux
$gamesType = new GamesType($infosType, $gameType);

// Type d'objet pour la liste d'éditeurs
$editorsType = new EditorsType($infosType, $editorType);

$studiosType = new StudiosType($infosType, $studioType);

// Définition du schéma
$schema = new Schema([
    'query' => new ObjectType([
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
                'resolve' => function ($rootValue) use ($gameRepository) {
                    return $gameRepository->getGames();
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
    ]),
]);

// Exécution de la requête GraphQL
try {
    $rawInput = file_get_contents('php://input');
    $input = json_decode($rawInput, true);
    $query = $input['query'];
    $variableValues = isset($input['variables']) ? $input['variables'] : null;

    $rootValue = null;
    $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
    $output = $result->toArray(Debug::INCLUDE_DEBUG_MESSAGE | Debug::INCLUDE_TRACE);

    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($output);
} catch (\Exception $e) {
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode([
        'errors' => [
            [
                'message' => $e->getMessage(),
            ],
        ],
    ]);
}
