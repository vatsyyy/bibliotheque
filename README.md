# API REST Bibliothèque

API REST développée en PHP 8.4 et MariaDB permettant de gérer une bibliothèque de livres.

## Technologies utilisées

- PHP 8.4
- MariaDB
- Apache
- PDO

## Installation

1. Cloner le dépôt :
   git clone https://github.com/vatsyyy/bibliotheque.git

2. Créer la base de données :
   mysql -u root -p < database.sql

3. Configurer la connexion dans config/database.php :
   $host = 'localhost';
   $dbname = 'bibliotheque';
   $username = 'root';
   $password = '';

## Endpoints

| Méthode | URL | Description |
|---------|-----|-------------|
| GET | /api/livres.php | Récupérer tous les livres |
| POST | /api/livres.php | Ajouter un livre |
| PUT | /api/livres.php | Modifier un livre |
| DELETE | /api/livres.php | Supprimer un livre |

## Exemples curl

### Ajouter un livre
curl -X POST http://localhost/bibliotheque/api/livres.php \
  -H "Content-Type: application/json" \
  -d '{"titre": "1984", "auteur": "George Orwell", "annee": 1949}'

### Modifier un livre
curl -X PUT http://localhost/bibliotheque/api/livres.php \
  -H "Content-Type: application/json" \
  -d '{"id": 1, "titre": "1984", "auteur": "George Orwell", "annee": 1949, "disponible": 0}'

### Supprimer un livre
curl -X DELETE http://localhost/bibliotheque/api/livres.php \
  -H "Content-Type: application/json" \
  -d '{"id": 1}'

## Sécurité

- Requêtes préparées PDO contre les injections SQL
- Accès direct à database.php bloqué via .htaccess
- Listage des fichiers désactivé
