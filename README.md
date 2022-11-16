# Api Champs

#### Una api para poder manejar campeones segun su Rol
##
## Endpoints:
##
##

## GET 
##### Obtiene todos los champs (limite por defecto hasta 10)
##
#### Enpoint:
```txt
localhost/TP2_w2/api/champs
```
### Ejemplo:
```txt
localhost/TP2_w2/api/champs
```
### Body:
##### SEND==>
##### <==RESPONSE
```json
[
    {
        "ID_champ" : "1",
        "Champ_name" : "Teemo",
        "ID_Rol" : "2",
        "Line_name" : "Adc",
        "Rol_name" : "Mago"
    },
    {
        "ID_champ" : "2",
        "Champ_name" : "Aatrox",
        "ID_Rol" : "4",
        "Line_name" : "Top",
        "Rol_name" : "Luchador"
    },
    {
        "ID_champ" : "3",
        "Champ_name" : "Sejuani",
        "ID_Rol" : "3",
        "Line_name" : "Jungla",
        "Rol_name" : "Tanque"
    }
]
```

##
## GET (/:ID)
##### Obtiene el champ con la :ID ingresada
##
#### Enpoint:
```txt
localhost/TP2_w2/api/champs/:ID
```
### Ejemplo:
```txt
localhost/TP2_w2/api/champs/1
```
### Body:
##### SEND==>
##### <==RESPONSE
```json
{
    "ID_champ" : "1",
    "Champ_name" : "Teemo",
    "ID_Rol" : "2",
    "Line_name" : "Adc",
    "Rol_name" : "Mago"
}
```

##
## POST
##### Agrega un champ a la db
##
#### Enpoint:
```txt
localhost/TP2_w2/api/champs
```
### Ejemplo:
```txt
localhost/TP2_w2/api/champs
```
### Body:
##### SEND==>
```json
{
    "Champ_name" : "Teemo",
    "ID_Rol" : "2",
    "Line_name" : "Adc",
}
```
##### <==RESPONSE
```json
{
    "ID_champ" : "1",
    "Champ_name" : "Teemo",
    "ID_Rol" : "2",
    "Line_name" : "Adc",
    "Rol_name" : "Mago"
}
```
###### (Devuelve el Champ agregado luego de buscarse en la db para confirmar)

##
## PUT
##### Modifica el Champ con la :ID de la db
##
#### Enpoint:
```txt
localhost/TP2_w2/api/champs/:ID
```
### Ejemplo:
```txt
localhost/TP2_w2/api/champs/1
```
### Body:
##### SEND==>
```json
{
    "Champ_name" : "Teemooo",
    "ID_Rol" : "2",
    "Line_name" : "Adc",
}
```
#### <==RESPONSE
```json
{
    "ID_champ" : "1",
    "Champ_name" : "Teemooo",
    "ID_Rol" : "2",
    "Line_name" : "Adc",
    "Rol_name" : "Mago"
}
```
###### (Devuelve el Champ editado luego de buscarse en la db para confirmar)

##
## Delete
##### Modifica el Champ con la :ID de la db
##
#### Enpoint:
```txt
localhost/TP2_w2/api/champs/:ID
```
### Ejemplo:
```txt
localhost/TP2_w2/api/champs/1
```
### Body:
##### SEND==>
##### <==RESPONSE
```txt
"El campeon se borro correctamente"
```

##
## Adicionales
###### Variables pasadas por GET en la url para especificar requisitos del endpoint GET
##
### Ordenamiento por una categoria
### sort
##### Obtiene los Champs ordenados en base a la categoria seleccionada
### Ejemplo:
##### SEND==>
```txt
?sort=ID_champs
```
##### <==RESPONSE
```json
[
    {
        "ID_champ" : "1",
        "Champ_name" : "Teemo",
        "ID_Rol" : "2",
        "Line_name" : "Adc",
        "Rol_name" : "Mago"
    },
    {
        "ID_champ" : "2",
        "Champ_name" : "Aatrox",
        "ID_Rol" : "4",
        "Line_name" : "Top",
        "Rol_name" : "Luchador"
    },
    {
        "ID_champ" : "3",
        "Champ_name" : "Sejuani",
        "ID_Rol" : "3",
        "Line_name" : "Jungla",
        "Rol_name" : "Tanque"
    }
]
```

##
### Formato de ordenamiento
### order
##### Obtiene los Champs con el ordenamiento indicado
### Ejemplo:
##### SEND==>
```txt
?sort=DESC
```
##### <==RESPONSE
```json
[
    {
    "ID_champ" : "3",
    "Champ_name" : "Sejuani",
    "ID_Rol" : "3",
    "Line_name" : "Jungla",
    "Rol_name" : "Tanque"
    },
    {
        "ID_champ" : "2",
        "Champ_name" : "Aatrox",
        "ID_Rol" : "4",
        "Line_name" : "Top",
        "Rol_name" : "Luchador"
    },
    {
        "ID_champ" : "1",
        "Champ_name" : "Teemo",
        "ID_Rol" : "2",
        "Line_name" : "Adc",
        "Rol_name" : "Mago"
    }
]
```

##
### Filtro de Champs
### filter
##### Obtiene los Champs los cuales tengan algun elemento (no ID) que sea igual al filtro
### Ejemplo:
##### SEND==>
```txt
?filter=Tanque
```
##### <==RESPONSE
```json
[
    {
        "ID_champ" : "3",
        "Champ_name" : "Sejuani",
        "ID_Rol" : "3",
        "Line_name" : "Jungla",
        "Rol_name" : "Tanque"
    },
    {
        "ID_champ" : "6",
        "Champ_name" : "Garen",
        "ID_Rol" : "3",
        "Line_name" : "Top",
        "Rol_name" : "Tanque"
    },
    {
        "ID_champ" : "7",
        "Champ_name" : "Shen",
        "ID_Rol" : "3",
        "Line_name" : "Top",
        "Rol_name" : "Tanque"
    }
]
```

##
### Paginacion
### page
##### Obtiene los 10 Champs (cantidad fija definida para evitar sobredemanda) segun la posicion de pagina indicada
### Ejemplo:
##### SEND==>
```txt
?page=1
```
##### <==RESPONSE
```json
[
    {
        "ID_champ" : "1",
        "Champ_name" : "Teemo",
        "ID_Rol" : "2",
        "Line_name" : "Adc",
        "Rol_name" : "Mago"
    },
    {
        "ID_champ" : "2",
        "Champ_name" : "Aatrox",
        "ID_Rol" : "4",
        "Line_name" : "Top",
        "Rol_name" : "Luchador"
    },
    {
        "ID_champ" : "3",
        "Champ_name" : "Sejuani",
        "ID_Rol" : "3",
        "Line_name" : "Jungla",
        "Rol_name" : "Tanque"
    },
    {
        "ID_champ" : "6",
        "Champ_name" : "Garen",
        "ID_Rol" : "3",
        "Line_name" : "Top",
        "Rol_name" : "Tanque"
    },
    {
        "ID_champ" : "7",
        "Champ_name" : "Shen",
        "ID_Rol" : "3",
        "Line_name" : "Top",
        "Rol_name" : "Tanque"
    },
    {
        "ID_champ" : "8",
        "Champ_name" : "Ashe",
        "ID_Rol" : "4",
        "Line_name" : "Adc",
        "Rol_name" : "Tirador"
    },
    {
        "ID_champ" : "9",
        "Champ_name" : "Varus",
        "ID_Rol" : "4",
        "Line_name" : "Adc",
        "Rol_name" : "Tirador"
    },
    {
        "ID_champ" : "10",
        "Champ_name" : "Tristana",
        "ID_Rol" : "4",
        "Line_name" : "Adc",
        "Rol_name" : "Tirador"
    },
    {
        "ID_champ" : "12",
        "Champ_name" : "Kindred",
        "ID_Rol" : "4",
        "Line_name" : "Jungla",
        "Rol_name" : "Tirador"
    },
    {
        "ID_champ" : "18",
        "Champ_name" : "Galio",
        "ID_Rol" : "3",
        "Line_name" : "Mid",
        "Rol_name" : "Tanque"
    }
]
```


##
# Autenticacion
##### Autenticación por JWT para poder modificar la API con sus POST/PUT/DELETE, donde se debe solicitar  primero un token, para su posterior uso en el bearer
##
#### Enpoint: localhost/TP2_w2/api/champs/:ID

### Ejemplo:
```txt
localhost/TP2_w2/api/auth/token
```
### Auth-Basic
##### SEND==>
```txt
Admin 12345
```
##### <==RESPONSE
```txt
"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwibmFtZSI6IkFkbWluIiwiZXhwIjoxNjY4NDU2ODA3fQ.3mXryYbZ6vIoH3_TO-uUphrmRxYqPnfrmWJMvdV1rqs"
```
###### Este token debe utilizarse con el Bearer sin las comillas