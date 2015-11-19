TwitterBis
========================

En Ticketbis queremos montarnos nuestra propia red social (parecida
a Twitter). La nostalgia ha podido con nosotros y hemos decidio que
sea una app de consola. La app que se pide debe
satisfacer los siguientes escenarios:

##Escenarios

 Publicar: Puedes publicar mensajes en tu muro
```
> Jose -> Eso no es paella, es arroz con cosas
> David -> Las 12h y ya estoy muerto de hambre
> David -> Alguien se viene al burger?
```
 Leer: David puede ver el timeline de Jose
```
> Jose
Eso no es paella, es arroz con cosas (hace 5 minutos)
> David
Alguien se viene al burger? (hace 1 minuto)
Las 12h y ya estoy muerto de hambre (hace 2 minutos)
```
 Following: Javi puede suscribirse al timeline de David y Jose
```
> Javi -> We are hiring!!
> Javi follows Jose
> Javi wall
Javi: We are hiring (hace 3 segundos)
Jose: Eso no es paella, es arroz con cosas (hace 5 minutos)

> Javi follows David
> Javi wall
Javi: We are hiring (hace 15 segundos)
David: Alguien se viene al burger? (hace 1 minuto)
David: Las 12h y ya estoy muerto de hambre (hace 2 minutos)
Jose: Eso no es paella, es arroz con cosas (hace 5 minutos)
```
Interactuar con bots: nuestros desarrolladores podrán ir implementando
bots a medida que los necesiten, pero para tener alguno desde el principio, 
se pide implementar el bot ranking, el cual sacara un listado con todos
los usuarios ordenados por número de mensajes publicados. El usuario que
lo solicita aparecerá resaltado de la siguiente forma:
```
> Javi #ranking
1. David (2)
2. Jose (1)
3. Javi (1) <-
```

## Comandos

Todos los comandos empiezan por el nombre del usuario

* post: <user> -> <message>
* read: <user>
* following: <user1> follows <user2>
* wall: <user> wall
* bot: <user> #<bot_name>

## Observaciones:

* Usa el lenguaje en el que te sientas más cómodo.
* La aplicación debe usar la consola como input y output.
* **No uses frameworks ni librerías externas (no uses Grails, Rails, Django ni similares. No uses ninguna bbdd). Queremos ver tu código, no el de los frameworks xD.**
* Valoramos mucho las buenas prácticas de diseño, por lo que ten en cuenta factores como la modularización, extensibilidad, mantenimiento, etc.
* Comenta tu código cuando lo consideres necesario.
* Implementa las estructuras de datos y algoritmos más eficientes que se te ocurran.
* Haznos saber cómo debemos ejecutar tu código.
* Extra ball: testing es más que bienvenido si te queda tiempo.