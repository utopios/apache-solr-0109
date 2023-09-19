**Création du schéma contact avec l'api**
```bash
curl -X POST -H 'Content-type:application/json' --data-binary '{
  "add-field": [
    {
      "name": "nom",
      "type": "string",
      "stored": true,
      "required": true
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