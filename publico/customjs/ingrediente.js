const btnNew=document.querySelector("#btnAgregar");
const panelDatos=document.querySelector("#contentList");
const panelForm=document.querySelector("#contentForm");
const btnCancelar=document.querySelector("#btnCancelar");
const tableContent=document.querySelector("#contentTable table tbody");
const searchText=document.querySelector("#txtSearch");
const pagination=document.querySelector(".pagination");
const formingrediente=document.querySelector("#formingrediente");
const API=new Api();
const objDatos={
    records:[],
    recordsFilter:[],
    currentPage:1,
    recordsShow:7,
    filter:""
};


eventListiners();

function eventListiners() {
    btnNew.addEventListener("click",agregaringrediente);
    
    btnCancelar.addEventListener("click",cancelaringrediente);

    document.addEventListener("DOMContentLoaded",cargarDatos);

    searchText.addEventListener("input",aplicarFiltro);

    formingrediente.addEventListener("submit",guardaringrediente);
}
function guardaringrediente(event) {
    event.preventDefault();
    const formData=new FormData(formingrediente);
    API.post(formData,"ingredientes/save").then(
        data=> {
            if (data.success) {
                cancelaringrediente();
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
    API.get("ingredientes/getAll").then(
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

function agregaringrediente() {
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    limpiarForm();
}

function limpiarForm() {
    formingrediente.reset();
    document.querySelector("#idingrediente").value="0";

}


function cancelaringrediente() {
    panelDatos.classList.remove("d-none");
    panelForm.classList.add("d-none");
    cargarDatos();
}


function crearTabla() {
    if (objDatos.filter==="") {
        objDatos.recordsFilter=objDatos.records.map(item=>item);
    } else {
        objDatos.recordsFilter=objDatos.records.filter(item=>{
            const {nombre_ingrediente,idproducto, costo_adicional}=item;
            if (nombre_ingrediente.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (costo_adicional.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (idproducto.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
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
                    <td>${item.nombre_ingrediente}</td>
                    <td>${item.idproducto}</td>
                    <td>$${item.costo_adicional}</td>
                    <td>
                        <button class="btn btn-primary" onclick="editaringrediente(${item.idingrediente})"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-danger" onclick="eliminaringrediente(${item.idingrediente})"><i class="bi bi-trash"></i></button>
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

function editaringrediente(idingrediente) {
    limpiarForm(1);
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    API.get("ingredientes/getOneingredientes?idingrediente="+idingrediente).then(
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
    const {idingrediente,nombre_ingrediente, idproducto, costo_adicional}=record;
    document.querySelector("#idingrediente").value=idingrediente;
    document.querySelector("#nombre_ingrediente").value=nombre_ingrediente;
    document.querySelector("#producto").value=idproducto;
    document.querySelector("#costo").value=costo_adicional;
}

function eliminaringrediente(idingrediente) {
    Swal.fire({
        title:"Esta seguro de eliminar el registro?",
        showDenyButton:true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(
        resultado=>{
            if (resultado.isConfirmed) {
                API.get("ingredientes/deleteingredientes?idingrediente="+idingrediente).then(
                    data=>{
                        if (data.success) {
                            cancelaringrediente();
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
