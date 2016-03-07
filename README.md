TwitterBis
========================

TwitterBis is a "Twitter like" command line application. It was requested to me by a company as a technical task during a 
hiring process. I think it has quite a good object oriented design, although I'm sure it can be still really improved.
I just want to have it here and keep improving it to show and train my OOP skills.

##Scenarios

 Publish: You can publish messages in your wall
```
> Jose -> This is not paella, it's rice with some stuff
> David -> It's 12 o'clock and I'm already really hungry!
> David -> Does someone want to go with me to the burger?
```
 Read: David is able to read Jose's timeline
```
> Jose
This is not paella, it's rice with some stuff (5 minutes ago)
> David
Does someone want to go with me to the burger? (1 minute ago)
It's 12 o'clock and I'm already really hungry! (2 minutes ago)
```
 Following: Javi is able to subscribes itself to David's and Jose's timeline
```
> Javi -> We are hiring!!
> Javi follows Jose
> Javi wall
Javi: We are hiring (3 seconds ago)
Jose: This is not paella, it's rice with some stuff (5 minutes ago)

> Javi follows David
> Javi wall
Javi: We are hiring (hace 15 segundos)
David: Does someone want to go with me to the burger? (1 minute ago)
David: It's 12 o'clock and I'm already really hungry! (2 minutes ago)
Jose: This is not paella, it's rice with some stuff (5 minutes ago)
```
Interacting with bots: our developers will be able to implement bots whenever they 
need it. Just to have one bot from the very beginning, you have to implement the 
ranking bot. Ranking bot shows a list with all the available users sorted by the
number of messages that everyone has published. The user who request the ranking
is shown highlighted in the following way:  
```
> Javi #ranking
1. David (2)
2. Jose (1)
3. Javi (1) <-
```

## Comands

Every command starts by the name of the user

* post: <user> -> <message>
* read: <user>
* following: <user1> follows <user2>
* wall: <user> wall
* bot: <user> #<bot_name>

## Syste requirements

* PHP >= 5.6

## Instructions

1. Clone this repositoty:
```
> git clone git@github.com:beni0888/twitterbis.git
``` 
2. Install dependencies via composer:
```
> cd /path/to/twitterbis
> php composer.phar install
```
3. Execute the application:
```
> php src/twitterbis.php
```
4. At the very beginning you have to provide the available user. Type one username 
per line. An empty line will finish the user loading.
```
> Javi
> David
> Jose
>
```
5. Type the commands you want to execute:
```
> Javi -> Hello World!
```
6. Type "exit" to finish.