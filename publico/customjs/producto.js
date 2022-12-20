const btnNew=document.querySelector("#btnAgregar");
const panelDatos=document.querySelector("#contentList");
const panelForm=document.querySelector("#contentForm");
const btnCancelar=document.querySelector("#btnCancelar");
const tableContent=document.querySelector("#contentTable table tbody");
const searchText=document.querySelector("#txtSearch");
const divfoto1=document.querySelector("#divFoto1");
const inputfoto1=document.querySelector("#foto1");
const divfoto2=document.querySelector("#divFoto2");
const inputfoto2=document.querySelector("#foto2");
const divfoto3=document.querySelector("#divFoto3");
const inputfoto3=document.querySelector("#foto3");
const pagination=document.querySelector(".pagination");
const formproducto=document.querySelector("#formproducto");
const API=new Api();
const objDatos={
    records:[],
    recordsFilter:[],
    currentPage:1,
    recordsShow:5,
    filter:""
};


eventListiners();

function eventListiners() {
    btnNew.addEventListener("click",agregarproducto);
    
    btnCancelar.addEventListener("click",cancelarproducto);

    document.addEventListener("DOMContentLoaded",cargarDatos);

    searchText.addEventListener("input",aplicarFiltro);

    formproducto.addEventListener("submit",guardarproducto);

    divfoto1.addEventListener("click",agregarfoto1);

    inputfoto1.addEventListener("change",actualizarfoto1);

    divfoto2.addEventListener("click",agregarfoto2);

    inputfoto2.addEventListener("change",actualizarfoto2);

    divfoto3.addEventListener("click",agregarfoto3);

    inputfoto3.addEventListener("change",actualizarfoto3);
}

function agregarfoto1() {
    inputfoto1.click();
}
function agregarfoto2() {
    inputfoto2.click();
}
function agregarfoto3() {
    inputfoto3.click();
}
function actualizarfoto1(el) {
    if (el.target.files && el.target.files[0]) {
        const reader=new FileReader();
        reader.onload=e=>{
            divfoto1.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" 
                        style="object-fit:contain;">`;
        }
        reader.readAsDataURL(el.target.files[0]);
    }
}
function actualizarfoto2(el) {
    if (el.target.files && el.target.files[0]) {
        const reader=new FileReader();
        reader.onload=e=>{
            divfoto2.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" 
                        style="object-fit:contain;">`;
        }
        reader.readAsDataURL(el.target.files[0]);
    }
}
function actualizarfoto3(el) {
    if (el.target.files && el.target.files[0]) {
        const reader=new FileReader();
        reader.onload=e=>{
            divfoto3.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" 
                        style="object-fit:contain;">`;
        }
        reader.readAsDataURL(el.target.files[0]);
    }
}
function guardarproducto(event) {
    event.preventDefault();
    const formData=new FormData(formproducto);
    API.post(formData,"productos/save").then(
        data=> {
            if (data.success) {
                cancelarproducto();
                Swal.fire({
                    icon:"info",
                    text:data.msg
                });
            } else {
                Swal.fire({
                    icon:"error",
                    title:"Error",
                    text:data.msg
                });
            }
        }
    ).catch(
        error=>{
            console.log("Error",error);
        }
    );
}


function aplicarFiltro(element) {
    element.preventDefault();
    objDatos.filter=this.value;
    crearTabla();
}


function cargarDatos() {
    API.get("productos/getAll").then(
        data=>{
            if (data.success) {
                objDatos.records=data.records;
                objDatos.currentPage=1;
                crearTabla();
            } else {
                console.log("Error al recuperar registros");
            }
        }
    ).catch(
        error=>{
            console.error("Error en la llamada:",error);
        }
    )
}

function agregarproducto() {
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    limpiarForm();
}

function limpiarForm() {
    formproducto.reset();
    document.querySelector("#idproducto").value="0";
    divfoto1.innerHTML="";
    divfoto2.innerHTML="";
    divfoto3.innerHTML="";

}


function cancelarproducto() {
    panelDatos.classList.remove("d-none");
    panelForm.classList.add("d-none");
    cargarDatos();
}


function crearTabla() {
    if (objDatos.filter==="") {
        objDatos.recordsFilter=objDatos.records.map(item=>item);
    } else {
        objDatos.recordsFilter=objDatos.records.filter(item=>{
            const {nombre_restaurante,nombre, ingredientes,descripcion, precio,total}=item;
            if (nombre.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (nombre_restaurante.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (descripcion.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (ingredientes.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (precio.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (total.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
        });
    }
    const recordIni=(objDatos.currentPage*objDatos.recordsShow)-objDatos.recordsShow;
    const recordFin=(recordIni+objDatos.recordsShow)-1;
    let html="";
    objDatos.recordsFilter.forEach(
        (item,index)=> {
            if ((index>=recordIni) && (index<=recordFin)) {
                html+=`
                    <tr>
                    <td>${index+1}</td>
                    <td>${item.nombre}</td>
                    <td>${item.descripcion}</td>
                    <td>${item.ingredientes}</td>
                    <td>${item.nombre_restaurante}</td>                              
                    <td>$${item.precio}</td>
                    <td>$${item.total}</td>
                    <td>
                        <button class="btn btn-primary" onclick="editarproducto(${item.idproducto})"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-danger" onclick="eliminarproducto(${item.idproducto})"><i class="bi bi-trash"></i></button>
                    </td>
                    </tr>
                `;
            }
        }
    );
    tableContent.innerHTML=html;
    crearPaginacion();
}

function crearPaginacion() {

    pagination.innerHTML="";

    const elAnterior=document.createElement("li");
    elAnterior.classList.add("page-item");
    elAnterior.innerHTML=`<a class="page-link" href="#">Anterior</a>`;
    elAnterior.onclick=()=>{
        objDatos.currentPage=(objDatos.currentPage==1 ? 1 : --objDatos.currentPage);
        crearTabla();
    };
    pagination.append(elAnterior);

    const totalPage=Math.ceil(objDatos.recordsFilter.length/objDatos.recordsShow);
    for (let i=1; i<= totalPage; i++) {
        const el=document.createElement("li");
        el.classList.add("page-item");
        el.innerHTML=`<a class="page-link" href="#">${i}</a>`;
        el.onclick=()=>{
            objDatos.currentPage=i;
            crearTabla();
        };
        pagination.append(el);
    }

    const elSiguiente=document.createElement("li");
    elSiguiente.classList.add("page-item");
    elSiguiente.innerHTML=`<a class="page-link" href="#">Siguiente</a>`;
    elSiguiente.onclick=()=> {
        objDatos.currentPage=(objDatos.currentPage==totalPage 
            ? totalPage : ++objDatos.currentPage);
        crearTabla();
    };
    pagination.append(elSiguiente);
}

function editarproducto(idproducto) {
    limpiarForm(1);
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    API.get("productos/getOneproductos?idproducto="+idproducto).then(
        data=>{
            if (data.success) {
                mostrarDatosForm(data.records[0]);
            } else {
                Swal.fire({
                    icon:"error",
                    title:"Error",
                    text:data.msg
                });
            }
        }
    ).catch(
        error=>{
            console.log("Error:",error);
        }
    );
}

function mostrarDatosForm(record) {
    const {idproducto,idrestaurante,nombre, descripcion,precio,foto1,foto3,foto2}=record;
    document.querySelector("#idproducto").value=idproducto;
    document.querySelector("#restaurante").value=idrestaurante;
    document.querySelector("#nombre").value=nombre;
    document.querySelector("#descripcion").value=descripcion;
    document.querySelector("#precio").value=precio;
    divfoto1.innerHTML=`<img src="${foto1}" class="h-100 w-100" 
    style="object-fit:contain;">`;
    divfoto2.innerHTML=`<img src="${foto2}" class="h-100 w-100" 
    style="object-fit:contain;">`;
    divfoto3.innerHTML=`<img src="${foto3}" class="h-100 w-100" 
    style="object-fit:contain;">`;
}

function eliminarproducto(idproducto) {
    Swal.fire({
        title:"Esta seguro de eliminar el registro?",
        showDenyButton:true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(
        resultado=>{
            if (resultado.isConfirmed) {
                API.get("productos/deleteproductos?idproducto="+idproducto).then(
                    data=>{
                        if (data.success) {
                            cancelarproducto();
                        } else {
                            Swal.fire({
                                icon:"error",
                                title:"Error",
                                text:data.msg
                            });
                        }
                    }
                ).catch(
                    error=>{
                        console.err("Error",error);
                    }
                );
            }
        }
    );
}
