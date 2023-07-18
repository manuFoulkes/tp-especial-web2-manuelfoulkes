# TP Especial Web 2

Para este TP especial he creado una API REST que permite obtener informacion sobre mi selección personal de albunes de algunas de mis bandas de rock favoritas.

## ¿Que podemos hacer con la API?

### Álbumes

1. [Listar todos los albunes](#listar-todos-los-albunes)
2. [Ver un album por su ID](#ver-un-album-por-su-id)
3. [Agregar un nuevo album](#agregar-un-nuevo-album)
4. [Eliminar un album](#eliminar-un-album)
5. [Valorar un album](#valorar-un-album)
6. [Ver todas las valoraciones de un album](#ver-todas-las-valoraciones-de-un-album)
7. [Ver la valoracion promedio de un album](#ver-la-valoracion-promedio-de-un-album)
8. [Editar una valoracion](#editar-una-valoracion)
9. [Eliminar una valoracion](#eliminar-una-valoracion)

### Artistas

1. [Listar todos los artistas](#listar-todos-los-artistas)
2. [Agregar un artista](#agregar-un-artista)
3. [Editar un artista](#editar-un-artista)
4. [Eliminar un artista](#eliminar-un-artista)

#### Listar todos los albunes

Para acceder al listado completo de albunes hay que hacer un GET al siguiente ednpoint:

```plaintext
"api/albunes"
```

El listado se puede ordenar por nombre:

```plaintext
"api/albunes?sort=nombre"
```

por genero:

```plaintext
"api/albunes?sort=genero"
```

se puede paginar:

```plaintext
"api/albunes?page=1&limit=5"
```

y se pueden combinar ambos:

```plaintext
"api/albunes?sort=nombre&page=1&limit=5"
```

#### Ver un album por su ID

Conociendo el ID del album podemos traer solamente ese album haciendo GET al endpoint:

```plaintext
"api/albun/:ID"
```

#### Agregar un nuevo album

Para agregar un album a la coleccion, primero hay que conocer a el ID del artista al que pertenece, y luego hacer un POST al siguiente endpoint

```plaintext
"api/album"
```

el body de la request debera cumplir con el siguiente formato

```json
    {
        "nombre" : "Beggars Banquet",
        "genero" : "Rock",
        "id_artista" : 4
    }
```

Importante: Tener en cuenta los tipos de cada campo.

#### Editar un album

Si conocemos el ID del album, podemos editarlo haciendo PUT al endpoint

```plaintext
"api/album/:ID"
```

El body de la request debera cumplir con el siguiente formato:

```json
    {
        "nombre" : "Beggars Banquet",
        "genero" : "Rock",
        "id_artista" : 4
    }
```

Importante: Tener en cuenta los tipos de cada campo.

#### Eliminar un album

Si conocemos el ID del album, podemos eliminarlo haciendo un DELETE al endpoint

```plaintext
"api/album/:ID"
```

***Importante***: La eliminacion es permanente.

#### Valorar un album

Conociendo el ID del album, podemos valorarlo haciendo POST al endpoint

```plaintext
"api/album/:ID/valoracion"
```

El body de la request debera cumplir con el siguiente formato:

```json
    {
        "valoracion" : 3
    }
```

**Importante**: Tener en cuenta que "valoracion" solo admite un numero entero entre 1 y 5.

#### Ver todas las valoraciones de un album

Si conocemos el ID del album, podemos listar las valoraciones que tenga haciendo GET al endpoint

```plaintext
"api/album/:ID/valoraciones"
```

#### Ver la valoracion promedio de un album

Si conocemos el ID del album, podemos ver que valoracion promedio tiene haciendo GET al endpoint

```plaintext
"api/album/:ID/valoracion-promedio"
```

#### Editar una valoracion

Si conocemos el ID de la valoracion que queremos editar, podemos modificarla haciendo POST al endpoint

```plaintext
"api/album/valoracion/:ID"
```

#### Eliminar una valoracion

Conociendo el ID de la valoracion, podemos eliminar una valoracion hecha haciendo DELETE al endpoint

```plaintext
"api/album/valoracion/:ID"
```

***Importante:*** La eliminacion es permanente

#### Listar todos los artistas

Podemos listar los artistas haciendo GET al siguiente endpoint

```plaintext
"api/artistas"
```

El listado se puede ordenar por nombre:

```plaintext
"api/artistas?sort=nombre"
```

se puede ordenar por genero:

```plaintext
"api/artistas?sort=genero"
```

se puede paginar:

```plaintext
"api/artistas?page=1&limit=5"
```

y se pueden combinar ambos:

```plaintext
"api/artistas?sort=nombre&page=1&limit=5"
```

#### Agregar un artista

Si queremos agregar un nuevo artista a la colección, podemos hacer un POST al siguiente endpoint

```plaintext
"api/artista"
```

El body de la request debera respetar el siguiente formato

```json
    {
        "nombre": "Rage Against the Machine",
        "genero": "Rock"
    }
```

**Importante:** Tener en cuenta los tipos de cada campo.

#### Editar un artista

Si conocemos el ID del artista, podemos editarlo haciendo PUT al endpoint:

```plaintext
"api/artista/:ID"
```

El body de la request debe respetar el siguiente formato

```json
    {
        "nombre": "Rage Against the Machine",
        "genero": "Rock"
    }
```

**Importante:** Tener en cuenta los tipos de cada campo.

#### Eliminar un artista

Si conocemos el ID del artista, podemos eliminarlo haciendo DELETE al siguiente endpoint:

```plaintext
"api/artista/:ID"
```

***Importante*** Solo se podran eliminar los artistas que no tengan asociados albunes. En ese caso primero se debera eliminar todos los albunes asociados. La eliminacion es permanente.
