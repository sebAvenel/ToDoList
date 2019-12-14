# Contribuer à ToDoList

Ce document décrit le wokflow git qui doit être utilisé lors de la contribution à des projets open source sur GitHub.
Il suppose une compréhension très basique de git (commits, branches, etc.) en utilisant la ligne de commande.
Pour ce document, nous supposerons que vous souhaitez apporter un correctif à [ToDoList](https://github.com/sebAvenel/ToDoList)

En tant que contributeur, voici les lignes directrices que nous aimerions que vous suiviez :

* [Correction des Bugs](#correction-des-bugs)
* [Demande de fonctionnalité](#nouvelle-fonctionnalité)
* [Guide de soumission](#guide-de-soumission)
* [Règle de Codage](#règle-de-codage)

## Correction des bugs

Si vous trouvez un bug dans le code source, vous pouvez nous aider en soumettant une [Issue](https://github.com/sebAvenel/ToDoList/issues) à notre dépôt GitHub.
Mieux encore, vous pouvez soumettre une [Pull Request](https://github.com/sebAvenel/ToDoList/pulls) avec un correctif.

## Nouvelle fonctionnalité

Vous pouvez proposer une nouvelle fonctionnalité en soumettant une [Issue](https://github.com/sebAvenel/ToDoList/issues) à notre dépôt GitHub.
Si vous souhaitez implémenter une nouvelle fonctionnalité, veuillez d'abord soumettre une [Issue](https://github.com/sebAvenel/ToDoList/issues).

* Dans le cas d'une fonctionnalitée majeur, ouvrez d'abord une [Issue](https://github.com/sebAvenel/ToDoList/issues) et décrivez-la avec le plus de précision possible.
* Les petites fonctionnalités peuvent être soumises directement par une [Pull Request](https://github.com/sebAvenel/ToDoList/pulls). En cas de doute soumettez une [Issue](https://github.com/sebAvenel/ToDoList/issues).

## Guide de soumission

* Pour la correction d'un bug, créez une branche `bugfix` depuis la branche `master`.
* Pour la soumission d'une nouvelle fonctionnalitée, créez une branche `new_feature` depuis la branche `develop`.

### Soumettre une Issue

Avant de soumettre une Issue, veuillez effectuer une recherche dans l'outil de suivi des Issues, peut-être qu'il existe déjà une Issue pour votre problème et que la discussion pourrait vous informer des solutions disponibles.

Nous voulons corriger tous les problèmes dès que possible, mais avant de corriger un bug, nous devons le reproduire et le confirmer. Afin de reproduire les bugs, nous vous demanderons systématiquement de fournir les informations suivantes :

* Version de ToDo List utilisée
* Bibliothèques tierces et leurs versions
* Un cas d'utilisation qui échoue

### Soumettre une Pull Request

Avant de soumettre votre Pull Request (PR), tenez compte des lignes directrices suivantes :

1. Recherchez sur GitHub pour une PR ouverte ou fermée qui se rapporte à votre soumission afin de s'assurer que ce problème n'a pas déjà été résolu.

2. Fork du repositorie ToDoList sur votre compte.

3. Clonez le repository
4. Faites vos changements dans une nouvelle branche git :

   ```bash
   git checkout -b bugfix
   ```

5. Créez votre patch, y compris les tests.

6. Suivez nos [règles de codage](#règle-de-codage).

7. Exécutez la suite de tests complète, et assurez-vous que tous les tests réussissent.

8. "Commit" vos modifications à l'aide d'un message de validation descriptif qui respecte les conventions de notre [guide des messages de Commit](#guide-des-messages-de-commit).

   ```bash
   git commit -m "Message de validation"
   ```

9. Poussez votre branche vers GitHub :

   ```bash
   git push origin bugfix
   ```

Si nous suggérons des changements, alors :

* Effectuez les mises à jour nécessaires.

* Ré-exécutez les suites de tests pour vous assurer que les tests sont toujours valide.

* Rebasez votre branche et forcez le push vers votre dépôt GitHub (cela mettra à jour votre Pull Request) :

   ```bash
   git rebase master -i
   git push -f
   ```

### Après la fusion de votre Pull Request

Vous pouvez supprimer votre branche en toute sécurité :

* Supprimez la branche distante sur GitHub :

   ```bash
   git push origin --delete feature/My-Issue
   ```

* Basculer la branche maître :

   ```bash
   git checkout master -f
   ```

* Supprimer la branche locale :

   ```bash
   git branch -D feature/My-Issue
   ```

* Mettez à jour votre branch master/develop avec la dernière version :

   ```bash
   git pull --ff upstream master
   ```

## Règle de Codage

Pour assurer la cohérence du code source, gardez ces règles à l'esprit lorsque vous travaillez :

* Toutes les fonctionnalités ou corrections de bogues doivent être testées par un ou plusieurs tests (tests unitaires et/ou fonctionnels).
* Nous respectons le guide de style [PSR1](https://www.php-fig.org/psr/psr-1), [PSR2](https://www.php-fig.org/psr/psr-2/) et [Symfony](https://symfony.com/doc/current/contributing/code/standards.html). Veuillez utiliser l'outil [php-cs-fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) pour vérifier votre code.

Exemple de commande:

```bash
php-cs-fixer fix src --rules=@Symfony,@PSR1,@PSR2
```

### Guide des messages de Commit

Les messages de Commit sont structurés de la manière suivante:

```xml
<type>(<scope>) : <description>
```

Le scope est facultatif.

1. **Type** :

   * **build** : Changements qui affectent les dépendances externes (par exemple : composer require/remove etc...)
   * **ci** : Modifications apportées aux fichiers de configuration
   * **doc** : Modifications de la documentation uniquement
   * **feat** : Une nouvelle fonctionnalitée
   * **fix** : Correction d'un bug
   * **perf** : Un changement de code qui améliore les performances
   * **refactor** : Un changement de code qui ne corrige pas un bogue et n'ajoute pas de fonctionnalité
   * **style** : Changements qui n'affectent pas la signification du code (espace blanc, formatage, points-virgules manquants, etc.)
   * **test** : Ajout de tests manquants ou correction de tests existants

2. **Scope** : (facultatif)

   * **form** : Changement affectant les formulaires
   * **controller** : Changement affectant les controllers
   * **config** : Changement affectant les fichiers de configuration
   * **entity** : Changement affectant les entités
   * **service** : Changement affectant les services
   * **security** : Changement affectant la sécurité (security.yml, annotation, ...)
   * **fixture** : Changement affectant les fixtures
   * **repo** : Changement affectant les repository
   * **listener** : Changement affectant les listeners
   * **command** : Changement affectant les lignes de commandes php(cli)
   * **view** : Changement affectant les vues de l'application

3. **Description** : Le sujet contient une description succincte du changement

   * utiliser l'impératif du présent : "change" pas "changed" ni "changes"
   * ne mettez pas la première lettre en majuscule
   * pas de point (.) à la fin