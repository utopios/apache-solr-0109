# Création instance solr => 9.3.0 => container, docker

# EndPoints API

- 1. Interaction avec schema
    - POST /core/schema 
    - exemple de body 
    ```
    {
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
            "name":"initial_release_date",
            "type":"pdate",
            "stored":true
          },
          {
            "name":"film_vector",
            "type":"knn_vector_10",
            "indexed":true,
            "stored":true
          }
        ]
      }
    ```

    # Formule de calcule de cache HEAP 

    TOTAL HEAP SIZE = FILTER CACHE * (Size total doc / 8) * num of Cores + field Value Caches * num of Cores (MISC cache(1 -> 4 G))  

    # Hash password basic authentication psswd (sha256)*dynamicSalt base64

    # EndPoint optimize => http://localhost:8983/solr/mycollection/update?optimize=true

    # EndPoint reload => http://localhost:8983/solr/admin/collections?action=RELOAD&name=mycollection
