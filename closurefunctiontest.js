
/*function test(x, y) {
    console.log(this, x, y);
}

var x=1;

//test.call({ bar : '1000s'}, 100);
//test.apply({ bar : '1000s'},[ 100, 200 ]);

var foo = function(){
    console.log(this.type);
    //console.log(arguments);
};

var obj = { type : 'cat' }
var args = [1,2,3,4,5];
//foo.apply(obj, args);

function bind(func, context) {
    console.log('1:',func, context);
    var v = function() {
        console.log('call g with arguments', arguments, arguments);
        return func.apply(context, arguments);
    };
    console.log('return v:',v);
    return v;
}

function f(a, b) {
  console.log( 'from f: this --> ',this );
  console.log( 'from f: a + b --> ', a + b );
}

var g = bind(f, "Context");
console.log('catch v as g:', g);
g(1, 2); // Context, затем 3*/


//Самовызываемая функция
//(function test(){
//    console.log(1000);
//})();


function defaultSayHi(){
    var message = this.sayHiText;
    
    if(typeof arguments[0] != 'undefined') 
        message += arguments[0];
    
    message+='!';
    alert(message);
}

var rabbit = {
    sayHiText : 'brrr!',
    sayHi : defaultSayHi
};
var cow = {
   sayHiText : 'mooouu!',
   sayHi : function(){
        defaultSayHi.call(this, '222');
    }
};

rabbit.sayHi();
cow.sayHi()


/*function makeRed(){
    console.log(this);
    this.style.color = 'red';
}
    
var anchor = document.createElement('a');
anchor.innerText = 'Hello';
anchor.href = '#';

anchor.onclick = makeRed;
document.body.appendChild(anchor);*/




