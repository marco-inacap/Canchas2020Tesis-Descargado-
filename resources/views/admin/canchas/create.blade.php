<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="POST" action="{{route('admin.cancha.store', '#create')}}">
      {{ csrf_field() }}
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group {{$errors->has('nombre') ? 'has-error':''}}">
                <label>Nombre de la Cancha </label>
                <input id="nombre-cancha" name="nombre" type="text" class="form-control" placeholder="Ingresa aquí el nombre de la Cancha" value="{{old('nombre')}}"  >
                {!!$errors->first('nombre','<span class="help-block">:message</span>')!!}
            </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
    </form>
  </div>

  @push('scripts')

  <script>

    if ( window.location.hash === '#create');
    {
      $('#myModal').modal('show');
    }
    
      $('#myModal').on('hide.bs.modal', function(){
          window.location.hash = '#';
      });
      $('#myModal').on('shown.bs.modal', function(){
          $('#nombre-cancha').focus();
          window.location.hash = '#create';
      });
    </script>
      
  @endpush