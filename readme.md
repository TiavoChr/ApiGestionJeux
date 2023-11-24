# API de Gestion de Jeux Vidéo

Cette API GraphQL permet de gérer une liste de jeux vidéo, d'éditeurs et de studios.

## Configuration

1. **Installer les dépendances :**
   vous pouvez effectuer la mise en place de l'environement du projet avec le fichier Dockerfile
   il faut mettre en place les dépendances php avec les commandes suivante:
   - composer install
   - composer require webonyx/graphql-php

Configurer la base de données :

Créer une base de données MySQL.
Exécuter les scripts dans le fichier apigraphqljeux.sql

mettre àn jour les information de connexion à votre base de données dans le fichier src/database/baseDeDonnee.php
    private $host = 'localhost';
    private $db = 'apigraphqljeux';
    private $user = 'root';
    private $pass = '';


Endpoints GraphQL http://Ip_de_votre_serveur/ApiGestionJeux
Pour le moment la version definitive de l'api avec index.php n'est pas encore tout à fait fonctionnel 
pour le moment la version fonctionnel avec l'url http://Ip_de_votre_serveur/ApiGestionJeux/api.php

L'API expose les points d'entrée suivants :
pour le moment on aurra le schéma:
type Query {
    games(

        page: Int

        genre: String

        platform: String

        studio: String

    ): Games

    game (id: ID!): Game

    editor (id: ID!): Editor

    studio (id: ID!): Studio
}
type Game {
    id: ID

    name: String!

    genres: [String!]! publicationDate: Int

    platform: [String!]!
}
type Editor {
    id: ID

    name: String!

    games: [Game] 
}
type Studios {
    id: ID

    name: String!

    games: [Game]
}



type Games {
   [Game]
}

=

Récupérer la liste des jeux
graphql
Copy code
query {
  games {
    results {
      id
      name
      genres
      publicationDate
      editors {
        id
        name
      }
      studios {
        id
        name
      }
      platform
    }
  }
}
Récupérer un jeu par ID
graphql
Copy code
query {
  game(id: 1) {
    id
    name
    genres
    publicationDate
    editors {
      id
      name
    }
    studios {
      id
      name
    }
    platform
  }
}
Récupérer la liste des éditeurs
graphql
Copy code
query {
  editors {
    infos {
      count
      pages
      nextPage
      previousPage
    }
    results {
      id
      name
    }
  }
}
Récupérer un éditeur par ID
graphql
Copy code
query {
  editor(id: 1) {
    id
    name
    games {
      id
      name
      genres
      publicationDate
      studios {
        id
        name
      }
      platform
    }
  }
}
Récupérer la liste des studios
graphql
Copy code
query {
  studios {
    infos {
      count
      pages
      nextPage
      previousPage
    }
    results {
      id
      name
    }
  }
}
Récupérer un studio par ID
graphql
Copy code
query {
  studio(id: 1) {
    id
    name
    games {
      id
      name
      genres
      publicationDate
      editors {
        id
        name
      }
      platform
    }
  }
}

