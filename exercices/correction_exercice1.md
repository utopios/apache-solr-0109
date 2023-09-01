1. solr create -c international_documents


2. 
```bash
curl -X POST -H 'Content-type:application/json' --data-binary  '{
    "add-field-type": {
        "name":"custom_text",
        "class": "solr.TextField",
        "indexAnalyzer": {
        "tokenizer": {
            "class": "solr.StandardTokenizerFactory"
        },
        "filters": [
            {"class": "solr.LowerCaseFilterFactory"},
            {"class": "solr.StopFilterFactory", "words": "lang/stopwords_en.txt", "ignoreCase": "true"}
        ]
    },
    "queryAnalyzer": {
        "tokenizer": {
            "class": "solr.StandardTokenizerFactory"
        },
        "filters": [
            {"class": "solr.LowerCaseFilterFactory"},
            {"class": "solr.StopFilterFactory", "words": "lang/stopwords_en.txt", "ignoreCase": "true"}
        ]
    }
    },
    "add-field": [
    {"name":"title_en", "type":"custom_text", "stored":true, "indexed":true
    
    },
    {"name":"title_fr", "type":"text_fr", "stored":true, "indexed":true},
    {"name":"title_es", "type":"text_es", "stored":true, "indexed":true},
    {"name":"description_en", "type":"text_en", "stored":true, "indexed":true},
    {"name":"description_fr", "type":"text_fr", "stored":true, "indexed":true},
    {"name":"description_es", "type":"text_es", "stored":true, "indexed":true},
    {"name":"pub_date", "type":"pdate", "stored":true, "indexed":false},
    {"name": "title_search", "type": "text_general", "indexed": true}
    ],
    "add-copy-field": [
        {"source": "title_en", "dest": "title_search"},
        {"source": "title_fr", "dest": "title_search"},
        {"source": "title_es", "dest": "title_search"},
    ],
    "add-dynamic-field": [
        {"name":"*_en", "type":"text_en", "stored":true, "indexed":true},
        {"name":"*_fr", "type":"text_fr", "stored":true, "indexed":true},
        {"name":"*_es", "type":"text_es", "stored":true, "indexed":true}
    ]
}' http://localhost:8983/solr/international_documents/schema
```

3. RequestHandler => à ajouter dans le fichier solrconfig.xml => /var/solr/data/<nom_core>
```xml
<requestHandler name="search" class="solr.SearchHandler">
<lst>
    <str name="qf">title_search</str>
    <str name="rows">20</str>
</lst>
</requestHandler>
```

4. test 
- ajout de documents 
```bash
curl -X POST -H 'Content-type:application/json' --data-binary '[
  {
    "title_en":"This is a test document in English",
    "description_en":"This document is used for testing purposes",
    "pub_date":"2023-01-01T00:00:00Z"
  },
  {
    "title_fr":"Ceci est un document de test en français",
    "description_fr":"Ce document est utilisé à des fins de test",
    "pub_date":"2023-01-01T00:00:00Z"
  },
  {
    "title_es":"Este es un documento de prueba en español",
    "description_es":"Este documento se utiliza para fines de prueba",
    "pub_date":"2023-01-01T00:00:00Z"
  }
]' http://localhost:8983/solr/international_documents/update?commit=true

```
