**Création du schéma contact avec l'api**
```bash
curl -X POST -H 'Content-type:application/json' --data-binary '{
  "add-field": [
    {
      "name": "nom",
      "type": "string",
      "stored": true,
      "required": true,
      "docValues: true
    },
    {
      "name": "prenom",
      "type": "string",
      "stored": true,
      "required": true
    }
  ]
}' http://localhost:8983/solr/contact/schema 
```

**Mise à jour atomique**
```bash
curl http://localhost:8983/solr/contact/update?commit=true -d '
[
  {
    "id": "1",
    "nom": "Dupont",
    "prenom": {
        "set" : "new Jean"
    }
} ]'
```

    "set": Définir ou remplacer une valeur.
    "add": Ajouter une nouvelle valeur à un champ multivalué.
    "inc": Augmenter la valeur d'un champ (doit être un champ numérique).
    "remove": Supprimer une valeur d'un champ multivalué.
    "removeregex": Supprimer toutes les valeurs correspondant à une expression régulière d'un champ multivalué.

**Suppression**
```bash
curl http://localhost:8983/solr/contact/update?commit=true -d '
[
  {
    "delete": {"id": "1"}  
  } 
]'
```


**Schéma films**
```bash
curl http://localhost:8983/solr/films/schema -X POST -H 'Content-type:application/json' --data-binary '{
        "add-field-type" : {
          "name":"knn_vector_10",
          "class":"solr.DenseVectorField",
          "vectorDimension":10,
          "similarityFunction":"cosine",
          "knnAlgorithm":"hnsw"
        },
        "add-field" : [
          {
            "name":"name",
            "type":"text_general",
            "multiValued":false,
            "stored":true
          },
          {
            "name":"directed_by",
            "type":"text_general",
            "multiValued":false,
            "stored":true,
            "docValues":true
          },
          {
            "name":"genre",
            "type":"string",
            "multiValued":true,
            "stored":true,
            "docValues": true
          },
          {
            "name":"initial_release_date",
            "type":"pdate",
            "stored":true,
            "docValues": true
          },
          {
            "name":"film_vector",
            "type":"knn_vector_10",
            "indexed":true,
            "stored":true
          },
          {
            "name": "localisation",
            "type": "location",
            "indexed": true,
            "stored": true,
            "docValues": true
            }
        ]
      }'
```