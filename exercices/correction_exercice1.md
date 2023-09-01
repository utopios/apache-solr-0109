1. solr create -c international_documents


2. 
```bash
curl -X POST -H 'Content-type:application/json' --data-binary  '{
    "add-field": [
    {"name":"title_en", "type":"text_en", "stored":true, "indexed":true, 
    "indexAnalyzer": {
        "tokenizer": {
            "class": "solr.StandardTokenizerFactory"
        },
        "filters": [
            {"class": "solr.LowerCaseFilterFactory"},
            {"class": "solr.StopFilterFactory", "words": "lang/stopword_en.txt", "ignoreCase": "true"}
        ]
    },
    "queryAnalyzer": {
        "tokenizer": {
            "class": "solr.StandardTokenizerFactory"
        },
        "filters": [
            {"class": "solr.LowerCaseFilterFactory"},
            {"class": "solr.StopFilterFactory", "words": "lang/stopword_en.txt", "ignoreCase": "true"}
        ]
    }
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

3. RequestHandler
```xml
<requestHandler name="search" class="solr.SearchHandler">
<lst>
    <str name="qf">title_search</str>
    <str name="rows">20</str>
</lst>
</requestHandler>
```