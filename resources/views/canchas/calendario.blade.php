@extends('new.layout2')

@section('meta-title')Reserva | {{$cancha->nombre}}@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">


<div class="counter">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-xl-4">
                <div class="image-container">
                    @if ($cancha->photos->count() === 1)
                    <figure>
                        <img src="{{ $cancha->photos->first()->url }}" alt="" class="img-fluid img-responsive">
                    </figure>
                    @elseif($cancha->photos->count() > 1)
                    @include('canchas.carousel')
                    @elseif($cancha->iframe)
                    <div class="video" width="100%" height="300">
                        {!! $cancha->iframe !!}
                    </div>
                    @endif
                </div> <!-- end of image-container -->
                <!-- Counter -->
                <div id="counter">
                    <div class="cell">
                        <div class="counter-value number-count" data-count="{{$visitas->total_visitas}}">{{$visitas->total_visitas}}</div>
                        <div class="counter-info">Total<br>Visitas</div>
                    </div>
                    <div class="cell">
                        <div class="counter-value number-count" data-count="{{count($cancha->complejo->reservas)}}">
                            {{count($cancha->complejo->reservas)}}</div>
                        <div class="counter-info">Nº<br>Reservas</div>
                    </div>
                </div>
                <div class="card-body">
                    <h3 class="card-title">{{$cancha->nombre}}</h3>
                    <p>{{$cancha->descripcion}}</p>
                    <ul class="list-unstyled li-space-lg">
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <a href="{{route('complejos.show', $cancha->complejo)}}">
                                <div class="media-body">{{$cancha->complejo->nombre}}</div>
                            </a>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">{{$cancha->complejo->ubicacion}}</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">${{number_format($cancha->precio,0, ',', '.')}}</div>
                        </li>
                    </ul>
                    Compartir: &nbsp;
                        <a href="https://www.facebook.com/sharer.php?u={{ request()->fullUrl()}}&t={{$cancha->nombre}}" title="Compartir en Facebook" target="_blank"><img alt="Share on Facebook" src="/img/flat_web_icon_set/Facebook.png"></a>
                        &nbsp;
                        <a href="https://api.whatsapp.com/send?text={{$cancha->nombre}}%20{{request()->fullUrl()}}" target="_blank" title="Tweet"><img alt="Tweet" src="/img/flat_web_icon_set/whatsapp.png"></a>
                </div>
                <div class="card-body">
                    @if (! $cancha->liked)
                    <a href="{{ route('canchas.like', $cancha) }}"><i class="far fa-thumbs-up like puntero"></i></a>
                    <span class="alert-info">{{ $cancha->likesCount }}</span>
                    @else
                    <a href="{{ route('canchas.unlike', $cancha) }}"><i class="fas fa-thumbs-up like nomegusta puntero"></i></a>
                    <span class="alert-info">{{ $cancha->likesCount }}</span>
                    @endif
            
                    @if (! $cancha->disliked)
                    <a href="{{ route('canchas.dislike', $cancha) }}"><i class="far fa-thumbs-down dislike puntero"></i></a>
                    <span class="alert-info">{{ $cancha->dislikesCount }}</span>
                    @else
                    <a href="{{ route('canchas.undislike', $cancha) }}"><i
                        class="fas fa-thumbs-down dislike nomegusta puntero"></i></a>
                    <span class="alert-info">{{ $cancha->dislikesCount }}</span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-xl-8">
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="alert-heading">Para reservar 👀</h4>
                    <p>Las fechas en color <b style="color: red; font-weight: bold;">rojo </b>son el tiempo en el que
                        esta cerrada la cancha.</p>
                    <hr>
                    <p class="mb-0"><img class="profile-user-img img-responsive img-circle"
                            style="width:20px; height:25px;" src="/img/select.png">Selecciona una fecha en el
                        calendario, para reservar <b style="font-size:20px">{{$cancha->nombre}}.</b></p>
                </div>
                <div class="text-container">
                    <div class="section-title">RESERVA</div>
                    <div class="card wizard-card" data-color="orange" id="wizardProfile">

                    </div>

                    <div id='calendar'></div>

                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of counter -->

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
                <button onclick="reservar()" type="button" class="btn-solid-reg page-scroll"
                    id="btnReservar">Reservar</button>
            </div>
        </div>
    </div>
</div>
@endsection



@push('styles')
<link rel="stylesheet" type="text/css" href="/css/twitter-bootstrap.css">
<link href='/fullcalendar/core/main.css' rel='stylesheet' />
<link href='/fullcalendar/daygrid/main.css' rel='stylesheet' />
<link href='/fullcalendar/list/main.css' rel='stylesheet' />
<link href='/fullcalendar/timegrid/main.css' rel='stylesheet' />
<script src="https://kit.fontawesome.com/42afc6e0a5.js" crossorigin="anonymous"></script>

@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

{{-- <script src="/js/twitter-bootstrap.js"></script> --}}
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
            height: 990,
            
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