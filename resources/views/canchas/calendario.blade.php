@extends('layout')

@section('meta-title')Reserva | {{$cancha->nombre}}@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">


<style>
    body {

        padding: 0;
        font-family: Arial Narrow;
    }
</style>

<body>
    <article class="pages container">
        <div class="page page-contact">
            <h1 class="text-black" style="font-size:15px;">Selecciona</h1>
            <h3 class="text-black text-right" style="font-size:15px;">Las fechas en color <b
                    style="color: red; font-weight: bold;">ROJO</b> son el tiempo en el que esta cerrada la cancha.</h1>
                <div class="footer content">
                    <img class="profile-user-img img-responsive img-circle" style="width:28px; height:35px;"
                        src="/img/select.png">
                    <h2 class="text-black text-center" style="font-size:20px;">Selecciona una fecha en el calendario,
                        para reservar <b style="font-size:25px">{{$cancha->nombre}}</b>.</h1>
                </div>
                <br>
                <div class="divider-2" style="margin:25px; text-align: center;"></div>
                <div class="col-md-12">
                    <div id='calendar'></div>
                </div>
        </div>
    </article>
</body>

<div class="modal fade bd-example-modal-sm" id="infoModal" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <ul class="list-group">
                <li class="list-group-item font-weight-bold active">
                    <input type="text" id="ModalComplejo" name="ModalComplejo" class="form-control" disabled>
                </li>

                <li class="list-group-item font-weight-bold">Usuario:
                    <input type="text" id="ModalUsuario" name="ModalUsuario" class="form-control" disabled>
                </li>
                <li class="list-group-item font-weight-bold">Hora Inicio:
                    <input type="time" id="ModalFechaInicio" name="ModalFechaInicio" class="form-control" disabled>
                </li>
                <li class="list-group-item font-weight-bold">Hora Fin:
                    <input type="time" id="ModalFechaFin" name="ModalFechaFin" class="form-control" disabled>
                </li>
                <li class="list-group-item font-weight-bold">Fecha:
                    <input type="date" id="ModalFecha" name="ModalFecha" class="form-control" disabled>
                </li>
                {{--  <li class="list-group-item font-weight-bold">Complejo: 
                    <input type="text" id="ModalComplejo" name="ModalComplejo" class="form-control"  disabled>
                </li>    --}}
            </ul>
            @if (Auth::user()->hasRole('Admin'))
            <div class="modal-footer">
                <a id="delete" data-href="{{ url('reservas') }}" data-id="" data-token="{{ csrf_token() }}"
                    class="btn btn-danger float-lg-left">Eliminar</a>
            </div>
            @endif
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reservar {{$cancha->nombre}} de
                    {{optional($cancha->complejo)->nombre}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formulario_agenda" action="{{route('reservar.guardar',$cancha)}}">
                    @csrf
                    <div class="form-group">
                        <label>Fecha.</label>
                        <input id="txtFecha" name="txtFecha" type="date" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label>Hora de reserva.</label>
                        <input id="txtHoraInicio" name="txtHoraInicio" type="time" class="form-control" value=""
                            disabled>
                    </div>

                    <div class="form-group">
                        <label>Tiempo para arrendar. (Minutos)</label>
                        <input id="txtTiempo" name="txtTiempo" type="number" class="form-control" value="60" disabled>
                    </div>

                    <div class="form-group">
                        <label>A nombre de: </label>
                        <input type="text" class="form-control" value="{{auth()->user()->name}}" disabled>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                <button onclick="reservar()" type="button"
                    style="background-color:rgb(0,188,159,0.4); border-color:rgb(0,200,159,0.4); " class="btn "
                    id="btnReservar">Reservar</button>
            </div>
        </div>
    </div>
</div>
@endsection



@push('styles')
<link href='/fullcalendar/core/main.css' rel='stylesheet' />
<link href='/fullcalendar/daygrid/main.css' rel='stylesheet' />
<link href='/fullcalendar/list/main.css' rel='stylesheet' />
<link href='/fullcalendar/timegrid/main.css' rel='stylesheet' />


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
@endpush

@push('scripts')
{{-- <script src="/fullcalendar/jQuery/jquery-3.5.1.js"></script>   --}}
{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>  --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


<script src='/fullcalendar/core/main.js'></script>
<script src='/fullcalendar/interaction/main.js'></script>
<script src='/fullcalendar/daygrid/main.js'></script>

<script src='/fullcalendar/list/main.js'></script>
<script src='/fullcalendar/timegrid/main.js'></script>




<script>
    var BASEURL = "{{ url('/') }}";
    var calendar = null; 
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        
        
        calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'dayGrid', 'interaction', 'timeGrid', 'list' ],
            defaultView: 'timeGridWeek',
            defaultTimedEventDuration: '01:00:00',
            header:{
                left:'prev,next today',
                center:'title',
                right:'dayGridMonth,timeGridWeek,timeGridDay,listMonth',
            },
            navLinks: true,
            selectable: true,
            height: 550,
            
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Día',
                list: 'Lista'
            },
            
            /* selectMirror: true, */

            //funcion para capturar datos del calendario al modal.

            //dateClick
            select:function(info){    
                
                let fecha = moment(info.start).format("YYYY-MM-DD H:mm");

                let fecha_modal = moment(fecha).format("YYYY-MM-DD");

                let hoy = moment(new Date()).format("YYYY-MM-DD H:mm");
                let hora_inicial = moment(info.start).format("HH:mm");

                if ( hoy <= fecha) {
                    $('#txtFecha').val(fecha_modal); 
                    $('#txtHoraInicio').val(hora_inicial); 
                    
                    $('#exampleModal').modal(); 
                }else{
                    Swal.fire({
                        icon:'warning',
                        text:'No puedes reservar en una fecha pasada.'})
                }  
                /* calendar.addEvent({title:"Evento x",date:info.dateStr});    */          
            },
            
            //array de eventos, para tarear varias url del controlador. FUENTES JSON
            
            eventSources: [
                {
                    url: '/reservas/{{$cancha->id}}/listar',
                    
                },
                {
                    url: '/horarios/{{$cancha->id}}/horarioCierre',
                
                }
            ],

            
            
/*              events: '/reservas/listar', 
            events: '/horarios/{{$cancha->id}}/horarioCierre',
             */
            //funcion para visualizar reservas en el calendario
            eventClick:function(info){
                /* console.log(info.event.start); */             

                let complejo = (info.event.classNames);
                let usuario = (info.event.title);
                let hora_inicial = moment(info.event.start).format("HH:mm");
                let hora_final = moment(info.event.end).format("HH:mm");
                let fecha = moment(info.event.start).format("YYYY-MM-DD");
                
                
                $('#infoModal #delete').attr('data-id', info.event.id);

                $('#ModalComplejo').val(complejo);
                $('#ModalUsuario').val(usuario); 
                $('#ModalFechaInicio').val(hora_inicial); 
                $('#ModalFechaFin').val(hora_final); 
                $('#ModalFecha').val(fecha); 
                
                $('#infoModal').modal();
                /* console.dir(info);  */
                
            }        
        });
        calendar.setOption('locale','Es');
        calendar.render();
    });

    $('#delete').on('click', function(){
            
            var x = $(this);
            var delete_url = x.attr('data-href')+'/'+x.attr('data-id');

            $.ajaxSetup({
                headers:{
                    'X_CSRF_TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: delete_url,
                type: 'DELETE',
                success: function(result){
                    $('#infoModal').modal('hide');
                    alert(result.message);
                    location.reload(true);//recarga de pagina
                },
                error: function(result){
                    $('#infoModal').modal('hide');
                    alert(result.message);
                }
            });
        });

    function pagar() { 
        /* window.location.href="/complejos/inicio/{{$cancha->id}}/reserva/index";  */
        setTimeout("location.href='/complejos/inicio/{{$cancha->id}}/reserva/index'", 3000);
    } 

    function limpiar(){

        $('#exampleModal').modal('hide');
        $('#infoModal').modal('hide');

    }
    
    

    

    function reservar(){
            
            var fd = new FormData(document.getElementById("formulario_agenda"));  
            
            let fecha = $("#txtFecha").val();
            let hora = $("#txtHoraInicio").val();
            let tiempo = $("#txtTiempo").val();
            let hora_inicial = moment(fecha+" "+hora).format("HH:mm");
            let hora_final = moment(fecha+" "+hora).add(tiempo,'m').format("HH:mm");
            let timerInterval;
            fd.append("txtHoraInicio",hora_inicial);
            fd.append("txtHoraFin",hora_final);

            $.ajax({

                url: "/reserva/{{$cancha->id}}/reservar",
                type:"POST",
                data:fd,
                processData:false,
                contentType:false

            }).done(function(respuesta){
                if(respuesta && respuesta.ok){   
                    calendar.refetchEvents();
                        
                        Swal.fire({
                        title: 'Agendando Reserva',
                        html: 'Espere<b></b> segundos.',
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                        allowOutsideClick: false,
                        timer: 3000,
                        timerProgressBar: true,
                        onBeforeOpen: () => {                         
                            Swal.showLoading()
                            timerInterval = setInterval(() => {
                            const content = Swal.getContent()
                            if (content) {
                                const b = content.querySelector('b')
                                if (b) {
                                b.textContent = Swal.getTimerLeft()
                                }
                            }
                            }, 3000)                          
                        }, 
                        
                        onClose: () => {
                            clearInterval(timerInterval)
                        }
                        
                        }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('I was closed by the timer')
                        }
                        })  
                        pagar(); 
                }else{
                        Swal.fire({
                            icon: 'warning',
                            title: ':(',
                            text: 'Ya se encuentra reservada esta cancha!',
                            footer: '<a href>Selecciona otra fecha u hora</a>',
                            closeOnEsc: true,            
                            })
                }       
            })
        }
</script>
@endpush