const botonusuarios=document.querySelector("#btnAgregar");
const panelDatosusuarios=document.querySelector("#contentList");
const panelFormusuarios=document.querySelector("#contentForm");
const btnCancelarusuario=document.querySelector("#btnCancelar");
const contentTableusuarios=document.querySelector("#contentTable table tbody");
const txtSearchusuarios=document.querySelector("#txtSearch");
const usuario_id=document.querySelector("#id_user");
const pagination=document.querySelector(".pagination");
const formusuario=document.querySelector("#formusuarios");
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
    formusuario.addEventListener("submit",guardarusuario);

    botonusuarios.addEventListener("click",agregarusuario);

    btnCancelarusuario.addEventListener("click",cancelarusuario);

    document.addEventListener("DOMContentLoaded",cargarDatosusuario);

    txtSearchusuarios.addEventListener("input",aplicarFiltrousuario);

}



function guardarusuario(event) {
    event.preventDefault();
    const formDatausuario=new FormData(formusuario);
    API.post(formDatausuario,"usuarios/saveusuarios").then(
        data=> {
            if (data.success) {
                cancelarusuario();
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


function aplicarFiltrousuario(element) {
    element.preventDefault();
    objDatos.filter=this.value;
    crearTablausuario();
}


function cargarDatosusuario() {
    API.get("usuarios/getAllusuarios").then(
        data=>{
            if (data.success) {
                objDatos.records=data.records;
                objDatos.currentPage=1;
                crearTablausuario();
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

function agregarusuario() {
    panelDatosusuarios.classList.add("d-none");
    panelFormusuarios.classList.remove("d-none");
    limpiarFormusuario();
}

function limpiarFormusuario() {
    formusuario.reset();
    document.querySelector("#id_user").value="0";
}


function cancelarusuario() {
    panelDatosusuarios.classList.remove("d-none");
    panelFormusuarios.classList.add("d-none");
    cargarDatosusuario();
}


function crearTablausuario() {
    if (objDatos.filter==="") {
        objDatos.recordsFilter=objDatos.records.map(item=>item);
    } else {
        objDatos.recordsFilter=objDatos.records.filter(item=>{
            const {usuario, password ,tipo}=item;
            if (usuario.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (password.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (tipo.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
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
                    <td>${item.usuario}</td>               
                    <td>${item.tipo}</td>
                    <td>
                        <button class="btn btn-primary" onclick="editarusuario(${item.id_user})"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-danger" onclick="eliminarusuario(${item.id_user})"><i class="bi bi-trash"></i></button>
                    </td>
                    </tr>
                `;
            }
        }
    );
    contentTableusuarios.innerHTML=html;
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

function editarusuario(id_user) {
    limpiarFormusuario(1);
    panelDatosusuarios.classList.add("d-none");
    panelFormusuarios.classList.remove("d-none");
    API.get("usuarios/getOneusuario?id_user="+id_user).then(
        data=>{
            if (data.success) {
                mostrarDatosFormusuarios(data.records[0]);
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

function mostrarDatosFormusuarios(record) {
    const {id_user, usuario ,password,tipo}=record;
    document.querySelector("#id_user").value=id_user;
    document.querySelector("#usuarios").value=usuario;
    document.querySelector("#password").value=password;
    document.querySelector("#tipo").value=tipo;
}


function eliminarusuario(id_user) {
    Swal.fire({
        title:"¿Esta seguro de eliminar el usuario?",
        showDenyButton:true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(
        resultado=>{
            if (resultado.isConfirmed) {
                API.get("usuarios/deleteusuario?id_user="+id_user).then(
                    data=>{
                        if (data.success) {
                            cancelarusuario();
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

