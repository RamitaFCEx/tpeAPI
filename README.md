TPE API de zooDigital: 

    Permite crear, borrar, modificar o consultar la informacion de los animales del zoologico.

REGLAS DE LA BASE DE DATOS:

    -No repetir nombres 
    -La "especie" tiene que tener un valor numerico que coincida con el id de algun item
        de la tabla especie de la base de datos

USANDO GET:

    endpoint: http://localhost/web2/tpeAPI/api/animales


Ejemplo de JSON recibido: 

    [
        {
            "id" : 14
            "nombre" : "Boxer",
            "color" : "marronNegro",
            "descripcion" : "zzz",
            "id_especie_fk : 9,
            "especie" : "perro"
        },
        {
            "id" : 15
            "nombre" : "Husky",
            "color" : "blancoNegro",
            "descripcion" : "zzz",
            "id_especie_fk : 9,
            "especie" : "perro"
        }
    ]
    
    
-Se obtiene un JSON que contiene todos los items de la tabla razas de la base de datos


-Usando:

    url?especie=$nombreEspecie
    
se obtiene un JSON que contiene todos
los items de la tabla raza que pertenezcan a la especie buscada.
Solo se aceptan valores string, otros tipos de datos son un bad request


-Usando: 

    url?order=ASC || url?order=DESC || url?order=asc || url?order=desc

se puede ordenar el JSON que contiene todos los items buscados, de manera ascendente o             descendente.
    Por defecto se ordena ASC
    No se aceptan otros valores, en cuyo caso es un bad request
 
 
-Usando:

    url?column=id || url?column=nombre || url?column=color || url?column=descripcion || url?column=especie

   se puede elegir la columna que se va a tener en cuenta           para realizar el ordenamiento de los items de la tabla raza de la base de datos.
    Por defecto se ordena segun la columna nombre
    No se aceptan otros valores, en cuyo caso es un bad request


-Al agregar 

    url?offset=$numero || url?lenght=$numero 

se puede paginar los items recibidos por la API.
    Solo se aceptan valores numericos, otros tipos de datos son un bad request


GET por id :

    endpoint: http://localhost/web2/tpeAPI/api/animales/:ID

se obtiene un JSON que contiene el item de la tabla
    raza cuyo id = $numero.
    Solo se aceptan valores numericos, otros tipos de datos son un bad request




Ejemplo de JSON aceptable para POST o PUT:

    {
        "nombre" : "Boxer",
        "color" : "marronNegro",
        "descripcion" : "zzz",
        "especie" : 9
    }

USANDO POST:
-Usando un JSON aceptable, se pueden crear items, siempre y
    cuando se respeten las reglas de la base de datos.

USANDO PUT:

    endpoint: http://localhost/web2/tpeAPI/api/animales/:ID

 se puede modificar el item cuyo id coincida con $numero,
    siempre y cuando se respeten las reglas de la base de datos.
    Se recibira un mensaje informando el exito de modificacion o la 
    ausencia del elemento buscado.
    Solo se aceptan valores numericos, otros tipos de datos son un bad request

USANDO DELETE:

    endpoint: http://localhost/web2/tpeAPI/api/animales/:ID
 
se puede borrar el item cuyo id coincida con $numero. Se recibira un mensaje informando el exito de borrado o la   
    ausencia del elemento buscado.
    Solo se aceptan valores numericos, otros tipos de datos son un bad request



