# API de Gestion de Jeux Vidéo

Cette API GraphQL permet de gérer une liste de jeux vidéo, d'éditeurs et de studios.

## Configuration

1. **Installer les dépendances :**
   bash
   composer install
Configurer la base de données :

Créer une base de données MySQL.
Copier le fichier .env.example en .env et configurer les paramètres de base de données.
Exécuter les migrations :

bash
Copy code
php artisan migrate
Endpoints GraphQL
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