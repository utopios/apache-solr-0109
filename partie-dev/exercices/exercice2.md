## Exercice utilsation d'api request

1. Recherchez tous les films avec le nom "Inception".
```bash 
curl http://localhost:8983/solr/films/select?q=name:inception
```
2. Trouvez tous les films réalisés entre 2000 et 2010.
```bash 
curl http://localhost:8983/solr/films/select?q=initial_release_date:[2000-01-01T00:00:00Z TO 2000-12-31T00:00:00Z]

curl http://localhost:8983/solr/films/select?q=initial_release_date:[NOW-10YEAR TO NOW]
```
3. Trouvez tous les films qui sont à la fois du genre "Action" et "Sci-Fi".

```bash
curl http://localhost:8983/solr/films/select?q=genre:("Action Film" AND "Science Fiction")
```

4. Trouvez tous les films réalisés soit par "Christopher Nolan" soit par "Steven Spielberg".

```bash
curl http://localhost:8983/solr/films/select?q=directed_by:("Christopher Nolan" OR "Steven Spielberg")
```

5. Trouvez tous les films du genre "Action" mais qui n'ont PAS été réalisés par "Michael Bay".

```bash
curl http://localhost:8983/solr/films/select?q=genre:"Action Film" -directed_by:"Michael Bay"
```

6. Recherchez les films qui contiennent le mot "War", mais accordez plus d'importance aux films du genre "Drama"

```bash
curl http://localhost:8983/solr/films/select?q=name:War^2 genre:Dram^5
```

7. Récupérez les films du genre "Romance", mais uniquement les 10 premiers résultats.

```bash
curl http://localhost:8983/solr/films/select?q=genre:"Romance Film"&start=0&rows=10
```