# Exercice 1

**Objectif** : Configurer Apache Solr pour créer une collection qui permettra d'indexer et de rechercher des documents multilingues, avec des champs dynamiques et des copies de champs.

**Contexte** :
Vous travaillez pour une entreprise internationale qui a besoin d'indexer des documents dans plusieurs langues (anglais, français et espagnol). Chaque document contient un titre, une description et une date de publication. Vous devez configurer Solr pour indexer ces documents et permettre des recherches efficaces.

**Tâches** :

  

1. Création de la collection :
- Créez une nouvelle collection appelée international_documents.

2. Configuration du schéma :

- Modifiez le fichier managed-schema de votre collection pour définir les champs suivants :
    - title_en : Le titre du document en anglais.
    - title_fr : Le titre du document en français.
    - title_es : Le titre du document en espagnol.
    - description_en : La description du document en anglais.
    - description_fr : La description du document en français.
    - description_es : La description du document en espagnol.
    - pub_date : La date de publication du document.

- Configurez les champs de texte pour utiliser des analyseurs spécifiques à chaque langue. Par exemple, le champ description_fr doit utiliser un analyseur qui inclut un filtre de mots vides français et un racinisateur français.

- Configurez Solr pour stocker mais ne pas indexer le champ pub_date.

3. Utilisation des champs dynamiques :
- Configurez Solr pour traiter automatiquement tous les champs dont le nom se termine par _en comme du texte en anglais, tous les champs dont le nom se termine par _fr comme du texte en français, et tous les champs dont le nom se termine par _es comme du texte en espagnol.

4. Utilisation des copies de champs :
- Configurez Solr pour copier automatiquement les valeurs des champs title_en, title_fr et title_es dans un champ title_search qui sera utilisé pour les recherches sur le titre dans toutes les langues.

5. Configuration de solrconfig.xml :
- Modifiez le fichier solrconfig.xml de votre collection pour ajouter un nouveau requestHandler qui permettra d'effectuer des recherches sur le champ title_search.

6. Test de la configuration :
- Indexez quelques documents d'exemple dans votre collection.
- Effectuez des recherches en utilisant le requestHandler que vous avez configuré pour vérifier que tout fonctionne comme prévu.