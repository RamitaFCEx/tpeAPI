TPE API de zooDigital: 
permite crear, borrar, modificar o consultar la informacion de los animales del zoologico.

Para usar la API se debe usar la siguiente url
http://localhost/web2/tpeAPI/api/animales

Ejemplo de JSON recibido: 
{
    "id" : 14
    "nombre" : "Boxer",
    "color" : "marronNegro",
    "descripcion" : "zzz",
    "id_especie_fk : 9,
    "especie" : "perro"
}

REGLAS DE LA BASE DE DATOS:
-No repetir nombres 
-La "especie" tiene que tener un valor numerico que coincida con el id de algun item
    de la tabla especie de la base de dato

USANDO GET:
-Se obtiene un JSON que contiene todos los items de la tabla razas de la base de datos

-Al agregar "/$numero" se obtiene un JSON que contiene el item de la tabla
    raza cuyo id = $numero.
    Solo se aceptan valores numericos, otros tipos de datos son un bad request

-Al agregar "?especie=$nombreEspecie" se obtiene un JSON que contiene todos
    los items de la tabla raza que pertenezcan a la especie buscada.
    Solo se aceptan valores string, otros tipos de datos son un bad request

-Al agregar "?order=ASC" o "?order=DESC" o "?order=asc" o "?order=desc" se puede ordenar el JSON que contiene todos los items buscados, de manera ascendente o             descendente.
    Por defecto se ordena ASC
    No se aceptan otros valores, en cuyo caso es un bad request
 
-Al agregar "?column=id" o "?column=nombre" o "?column=color" o "?column=descripcion" o "?column=especie" se puede elegir la columna que se va a tener en cuenta           para realizar el ordenamiento de los items de la tabla raza de la base de datos.
    Por defecto se ordena segun la columna nombre
    No se aceptan otros valores, en cuyo caso es un bad request

-Al agregar "?lenght=$numero" y "?offset=$numero" se puede paginar los items recibidos por la API.
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
-Al agregar "/$numero" se puede modificar el item cuyo id coincida con $numero,
    siempre y cuando se respeten las reglas de la base de datos.
    Se recibira un mensaje informando el exito de modificacion o la 
    ausencia del elemento buscado.
    Solo se aceptan valores numericos, otros tipos de datos son un bad request

USANDO DELETE:
-Al agregar "/$numero" se puede borrar el item cuyo id coincida con $numero. Se recibira un mensaje informando el exito de borrado o la   
    ausencia del elemento buscado.
    Solo se aceptan valores numericos, otros tipos de datos son un bad request



