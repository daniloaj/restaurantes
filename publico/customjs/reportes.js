const btnViewReport=document.querySelector("#btnViewReport");
const CodigoDesde=document.querySelector("#desde");
const CodigoHasta=document.querySelector("#hasta");
const codigorestaurante=document.querySelector("#restaurante");
const producto=document.querySelector("#producto");
const frameReporte=document.querySelector("#framereporte");
const API = new Api();

eventListenner();

function eventListenner() {
    document.addEventListener("DOMContentLoaded",cargarrestaurante);
    document.addEventListener("DOMContentLoaded",cargarDatos);
    document.addEventListener("DOMContentLoaded",cargarDesde);
    document.addEventListener("DOMContentLoaded",cargarProducto);
    btnViewReport.addEventListener("click",verReporte);
}


function cargarDesde() {
    API.get("restaurantes/getAllrestaurantes").then(
        data=>{
            if (data.success) {
                CodigoDesde.innerHTML="";
                const optionrestaurante=document.createElement("option");
                optionrestaurante.value="0";
                optionrestaurante.textContent="Todos";
                CodigoDesde.append(optionrestaurante);
                data.records.forEach(
                    (item)=>{
                        const {idrestaurante}=item;
                        const optionrestaurante=document.createElement("option");
                        optionrestaurante.value=idrestaurante;
                        CodigoDesde.append(optionrestaurante);
                    }
                );
            }
        }
    ).catch(
        error=>{
            console.error("Error:",error);
        }
    );
}

function cargarDatos() {
    API.get("restaurantes/getAllrestaurantes").then(
        data=>{
            if (data.success) {
                CodigoHasta.innerHTML="";
                const optionrestaurante=document.createElement("option");
                optionrestaurante.value="0";
                CodigoHasta.append(optionrestaurante);
                data.records.forEach(
                    (item)=>{
                        const {idrestaurante}=item;
                        const optionrestaurante=document.createElement("option");
                        optionrestaurante.value=idrestaurante;
                        CodigoHasta.append(optionrestaurante);
                    }
                );
            }
        }
    ).catch(
        error=>{
            console.error("Error:",error);
        }
    );
}
function cargarrestaurante() {
    API.get("restaurantes/getAllrestaurantes").then(
        data=>{
            if (data.success) {
                codigorestaurante.innerHTML="";
                const optionrestaurante=document.createElement("option");
                optionrestaurante.value="0";
                optionrestaurante.textContent="Todos";
                codigorestaurante.append(optionrestaurante);
                data.records.forEach(
                    (item)=>{
                        const {nombre_restaurante}=item;
                        const optionrestaurante=document.createElement("option");
                        optionrestaurante.value=nombre_restaurante;
                        optionrestaurante.textContent=nombre_restaurante;
                        codigorestaurante.append(optionrestaurante);
                    }
                );
            }
        }
    ).catch(
        error=>{
            console.error("Error:",error);
        }
    );
}
function cargarProducto() {
    API.get("productos/getAll").then(
        data=>{
            if (data.success) {
                producto.innerHTML="";
                const optionproducto=document.createElement("option");
                optionproducto.value="0";
                optionproducto.textContent="Todos";
                producto.append(optionproducto);
                data.records.forEach(
                    (item)=>{
                        const {nombre}=item;
                        const optionproducto=document.createElement("option");
                        optionproducto.value=nombre;
                        optionproducto.textContent=nombre;
                        producto.append(optionproducto);
                    }
                );
            }
        }
    ).catch(
        error=>{
            console.error("Error:",error);
        }
    );
}

function verReporte() {
   frameReporte.src=`${BASE_API}reportes/getReporte?restaurante=${codigorestaurante.value}&desde=${CodigoDesde.value}&hasta=${CodigoHasta.value}&producto=${producto.value}`;
}