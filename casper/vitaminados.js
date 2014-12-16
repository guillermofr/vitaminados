/*==============================================================================*/
/* Casper generated Fri Dec 12 2014 21:00:56 GMT+0100 (Hora estándar romance) */
/*==============================================================================*/

var user = casper.cli.get("user");

var x = require('casper').selectXPath;
casper.options.viewportSize = {width: 1150, height: 615};
casper.on('page.error', function(msg, trace) {
   this.echo('Error: ' + msg, 'ERROR');
   for(var i=0; i<trace.length; i++) {
       var step = trace[i];
       this.echo('   ' + step.file + ' (line ' + step.line + ')', 'ERROR');
   }
});
casper.test.begin('Resurrectio test', function(test) {
   casper.start('http://vitaminados.local/jugar');
   

   casper.waitForSelector("form input[name='email']",
       function success() {
           test.assertExists("form input[name='email']");
           this.click("form input[name='email']");
       },
       function fail() {
           test.assertExists("form input[name='email']");
   });
   casper.waitForSelector("input[name='email']",
       function success() {
            console.log("usamos mail "+ user+"@bot.com");
           this.sendKeys("input[name='email']", user+"@bot.com");
       },
       function fail() {
           test.assertExists("input[name='email']");
   });
   casper.waitForSelector("form button",
       function success() {
           test.assertExists("form button");
           this.click("form button");
       },
       function fail() {
           test.assertExists("form button");
   });
   /* submit form */
   
   
   casper.waitForSelector(x("//a"),
       function success() {
           test.assertExists(x("//a"));
           this.click(x("//a"));
       },
       function fail() {
           test.assertExists(x("//a"));
   });
   
 
   casper.waitForSelector("input[name='nick']",
       function success() {
           this.sendKeys("input[name='nick']", user);
           casper.waitForSelector("form button",
               function success() {
                   test.assertExists("form button");
                   this.click("form button");
               },
               function fail() {
                   //test.assertExists("form button");
           });
       },
       function fail() {
           //test.assertExists("input[name='nick']");
   });

   
   /* submit form */
   

   /*rellenar captcha*/
   casper.repeat(1000,function() {
       this.waitForSelector("form#form_juego button#enviar_captcha:enabled",
           function success() {
               test.assertExists("form#form_juego button#enviar_captcha:enabled");

               //si hay vitaminas la lanzas
              vitaminas = null;
              vitaminas = this.evaluate(function() {
                  var vit = document.querySelectorAll('.vitamina');
                  return Array.prototype.map.call(vit, function(e) {
                    return e.getAttribute('id');
                  });
              });

              console.log("vitaminas", vitaminas.length);
              if (vitaminas.length){
                console.log("Usar vitamina", vitaminas[0]);

                var buenas = new Array("14", "27", "30", "38", "39", "49", "2", "32", "33", "1", "11", "34", "48");

                var target;

                if(buenas.indexOf(vitaminas[0]) != -1)
                {
                   console.log("Usar vitamina conmigo", vitaminas[0]);
                   target = "me";
                } else  {
                   console.log("Usar vitamina con otro", vitaminas[0]);
                   target = "first";
                }
                //console.log('http://vitaminados.local/api/usar_vitamina/'+vitaminas[0]+'/'+target);
                var wsurl = 'http://vitaminados.local/api/usar_vitamina/'+vitaminas[0]+'/'+target;
                    data = this.evaluate(function(wsurl) {
                        return __utils__.sendAJAX(wsurl, 'POST', null, false);
                    }, {wsurl: wsurl});

                // usar una vitamina
                //http://vitaminados.local/api/usar_vitamina/46/166

              }
              
              this.click("form#form_juego button#enviar_captcha:enabled");
              


           },
           function fail() {
               //test.assertExists("form#form_juego button#enviar_captcha:enabled");
       });
    });

       

   casper.run(function() {test.done();});
});