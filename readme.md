# API de Gestion de Jeux Vidéo

Cette API GraphQL permet de gérer une liste de jeux vidéo, d'éditeurs et de studios.

## Configuration

1. **Installer les dépendances :**
   bash
   composer install
Configurer la base de données :

Créer une base de données MySQL.
Exécuter les scripts dans le fichier apigraphqljeux.sql

mettre àn jour les information de connexion à votre base de données dans le fichier src/database/baseDeDonnee.php
    private $host = 'localhost';
    private $db = 'apigraphqljeux';
    private $user = 'root';
    private $pass = '';


Endpoints GraphQL http://Ip_de_votre_serveur/ApiGestionJeux
L'API expose les points d'entrée suivants :

Récupérer la liste des jeux
graphql
Copy code
query {
  games {
    infos {
      count
      pages
      nextPage
      previousPage
    }
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

Note : Assurez-vous d'avoir Composer installé pour gérer les dépendances du projet. Utilisez composer install pour installer les dépendances nécessaires.