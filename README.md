# test_CDL
Test Symfony 4, 5

Projet test - Village Library

Condition

Vous êtes le nouveau développeur de la bibliothèque de votre village comptant 100 habitants. Afin
de faciliter la vie de votre bibliothécaire, vous décidez de lui créer un module en Symfony4 de type
CRUD. Elle vous a laissé le tableau ci-dessus pour commencer à remplir votre base de données.

1/ Créer une page pour afficher l'ensemble des livres.
Sur cette page, nous pourrons filtrer les livres par "nom", "date", "auteur" ou "catégorie".
Il sera aussi possible d'éditer et de supprimer les livres

2/ - Créer un page pour créer un livre.
Chaque livre est associé à une catégorie existante ou alors avoir la possibilité de créer une
catégorie.
Chaque livre peut avoir un auteur existant ou alors avoir la possibilité de créer un auteur.
- Créer une page pour créer une catégorie.
- Créer une page pour créer un auteur.
- Insérer les données de ce tableau
livre et catégorie ne peuvent pas etre NULL.

3/ La bibliothécaire veut pouvoir rechercher tous les livres dont la catégorie est "roman" ou
"manga" et dont la date de naissance de l'auteur est supérieure à 1970
Je veux une recherche de livre « avancée » avec la possibilité d’avoir deux catégories ou plus
sélectionnées en même temps + une date (qui sera : « A partir de XXXX année » // le champ
date peut rester vide, ce qui veut dire « toutes les date »)

/ ! \ La gestion des erreurs est primordiale !
Merci de gérer le contenu avec des EntityType
Les champs « date » n’acceptent que des dates.

Je ne veux pas de data en dur dans les filtres => tous dois être récupéré de la bdd.
