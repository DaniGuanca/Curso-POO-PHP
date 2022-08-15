function Fibonaccci(n) {
    let a = 0;
    let b = 1;
    let c;
    let arreglo = new Array();
    arreglo[0] = 1;

    for(let i=0; i<n-1; i++){
        c = a +b;
        a = b;
        b = c;
        arreglo[i+1] = c;
    }

    let resultado = arreglo[n-1];
    return resultado;
}


console.log(Fibonaccci(1));