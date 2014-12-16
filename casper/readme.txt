Este script hecho en casper.js sobre phantom.js sirve para simular un bot que 
se registra , loguea , rellena capchas y tira vitaminas. 

No rellena capchas , solo le da al boton de submit del capcha, por detrás, el 
controller le dará capcha correcto si proviene de localhost, vitaminados.local

Se le ha puesto una tasa de fallo para que no llegue a combos muy altos

Siempre tirará la primera vitamina que tenga en el pastillero, y dependiendo de
si es buena o mala, la tirará sobre el mismo o sobre el primero de la lista.

se lanza desde línea de comandos

casperjs test vitaminados.js --user=botX