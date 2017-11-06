# Chemin d'accès :
#### http://local/index.php/users/list où 'local' est une adresse de votre serveur apache

# base de donnée
## Créer une base de donnée avec les tables suivantes : 

Table : apples -->
Columns : (int)id, (varchar)variety, (float)price

Table : users -->
Columns : (int)id, (varchar)nom, (varchar)prenom

Table : user_has_apple -->
Columns : (int)id, (int)user_id, (int)apple_id

Normalement ça devrait fonctionner ^o^