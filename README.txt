TPE API

ejemplo de JSON aceptable para POST o PUT:
{
    "nombre" : "Boxer",
    "color" : "marronNegro",
    "descripcion" : "zzz",
    "especie" : 9
}

REGLAS DE LA BASE DE DATOS:
-No repetir nombres 
-La "especie" tiene que tener un valor numerico que coincida con el id de algun item
de la tabla especie de la base de dato

para usar la API se debe usar la siguiente url
http://localhost/web2/tpeAPI/api

USANDO GET:
al agregar "/items" se obtiene un JSON que contiene todos los items de la tabla
razas de la base de datos

al agregar "/tems/$numero" se obtiene un JSON que contiene el item de la tabla
raza cuyo id = $numero

al agregar "/items?id_especie_fk=$numero" se obtiene un JSON que contiene todos
los items de la tabla raza cuyo id_especie_fk=$numero

al agregar "/items?oreder=ASC" o "/items?oreder=DESC" se puede ordenar el 
JSON que contiene todos los items de la tabla raza de la base de datos, de manera ascendente o descendente.
Por defecto se ordena ASC
 
al agregar "items?column=id" o "items?column=color" o "items?column=descripcion" o "items?column=id_especie_fk" se puede elegir la columna que se va a tener en 
cuenta para realizar el ordenamiento de los items de la tabla raza de la base de datos.
Por defecto se ordena segun la columna nombre


USANDO POST:
 al agregar "/items" y usando un JSON aceptable, se pueden crear items, siempre y
cuando se respeten las reglas de la base de datos

USANDO PUT:
al agregar "/items/$numero" se puede modificar el item cuyo id coincida con $numero,
siempre y cuando se respeten las reglas de la base de datos

USANDO DELETE:
al agregar "/items/$numero" se puede borrar el item cuyo id coincida con $numero




