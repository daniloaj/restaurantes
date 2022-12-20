const btnNew=document.querySelector("#btnAgregar");
const panelDatos=document.querySelector("#contentList");
const panelForm=document.querySelector("#contentForm");
const btnCancelar=document.querySelector("#btnCancelar");
const tableContent=document.querySelector("#contentTable table tbody");
const searchText=document.querySelector("#txtSearch");
const divFoto=document.querySelector("#divFoto");
const inputFoto=document.querySelector("#foto");
const pagination=document.querySelector(".pagination");
const formrestaurante=document.querySelector("#formrestaurante");
const API=new Api();
const objDatos={
    records:[],
    recordsFilter:[],
    currentPage:1,
    recordsShow:4,
    filter:""
};


eventListiners();

function eventListiners() {
    btnNew.addEventListener("click",agregarrestaurante);
    
    btnCancelar.addEventListener("click",cancelarrestaurante);

    document.addEventListener("DOMContentLoaded",cargarDatos);

    searchText.addEventListener("input",aplicarFiltro);

    formrestaurante.addEventListener("submit",guardarrestaurante);

    divFoto.addEventListener("click",agregarFoto);

    inputFoto.addEventListener("change",actualizarFoto);

}

function agregarFoto() {
    inputFoto.click();
}

function actualizarFoto(el) {
    if (el.target.files && el.target.files[0]) {
        const reader=new FileReader();
        reader.onload=e=>{
            divFoto.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" 
                        style="object-fit:contain;">`;
        }
        reader.readAsDataURL(el.target.files[0]);
    }
}

function guardarrestaurante(event) {
    event.preventDefault();
    const formData=new FormData(formrestaurante);
    API.post(formData,"restaurantes/save").then(
        data=> {
            if (data.success) {
                cancelarrestaurante();
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
    API.get("restaurantes/getAll").then(
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

function agregarrestaurante() {
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    limpiarForm();
}

function limpiarForm() {
    formrestaurante.reset();
    document.querySelector("#idrestaurante").value="0";
    divFoto.innerHTML="";
}


function cancelarrestaurante() {
    panelDatos.classList.remove("d-none");
    panelForm.classList.add("d-none");
    cargarDatos();
}


function crearTabla() {
    if (objDatos.filter==="") {
        objDatos.recordsFilter=objDatos.records.map(item=>item);
    } else {
        objDatos.recordsFilter=objDatos.records.filter(item=>{
            const {nombre_restaurante, direccion, contacto ,fecha_ingreso,latitud,longitud,telefono}=item;
            if (nombre_restaurante.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (direccion.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (contacto.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (fecha_ingreso.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (latitud.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (longitud.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (telefono.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
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
                    <td>${item.nombre_restaurante}</td>
                    <td>${item.direccion}</td>                              
                    <td>${item.telefono}</td>
                    <td>${item.contacto}</td>
                    <td>${item.fecha_ingreso}</td>
                    <td>${item.latitud}</td>
                    <td>${item.longitud}</td>
                    <td>
                        <button class="btn btn-primary" onclick="editarrestaurante(${item.idrestaurante})"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-danger" onclick="eliminarrestaurante(${item.idrestaurante})"><i class="bi bi-trash"></i></button>
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

function editarrestaurante(idrestaurante) {
    limpiarForm(1);
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    API.get("restaurantes/getOnerestaurantes?idrestaurante="+idrestaurante).then(
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
    const {idrestaurante, nombre_restaurante, direccion,contacto,foto, fecha_ingreso, latitud, longitud , telefono}=record;

    var vMarker;
    var map;

        map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 14,
            center: new google.maps.LatLng(latitud, longitud),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        vMarker = new google.maps.Marker({
            position: new google.maps.LatLng(latitud, longitud),
            draggable: true
        });
        google.maps.event.addListener(vMarker, 'dragend', function (evt) {
            $("#latitud").val(evt.latLng.lat().toFixed(6));
            $("#longitud").val(evt.latLng.lng().toFixed(6));

            map.panTo(evt.latLng);
        });
        map.setCenter(vMarker.position);
        vMarker.setMap(map);

        function movePin() {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            "address": inputAddress
        }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                vMarker.setPosition(new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng()));
                map.panTo(new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng()));
                $("#latitud").val(results[0].geometry.location.lat());
                $("#longitud").val(results[0].geometry.location.lng());
            }

        });
    }

    document.querySelector("#idrestaurante").value=idrestaurante;
    document.querySelector("#nombre_restaurante").value=nombre_restaurante;
    document.querySelector("#direccion").value=direccion;
    document.querySelector("#contacto").value=contacto;
    document.querySelector("#fecha_ingreso").value=fecha_ingreso;
    document.querySelector("#latitud").value=latitud;
    document.querySelector("#longitud").value=longitud;
    document.querySelector("#telefono").value=telefono;
    divFoto.innerHTML=`<img src="${foto}" class="h-100 w-100" 
    style="object-fit:contain;">`;
}


function eliminarrestaurante(idrestaurante) {
    Swal.fire({
        title:"Esta seguro de eliminar el registro?",
        showDenyButton:true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(
        resultado=>{
            if (resultado.isConfirmed) {
                API.get("restaurantes/deleterestaurantes?idrestaurante="+idrestaurante).then(
                    data=>{
                        if (data.success) {
                            cancelarrestaurante();
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
