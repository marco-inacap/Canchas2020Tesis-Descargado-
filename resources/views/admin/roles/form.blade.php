                        {{ csrf_field() }}

                    <div class="form-group {{$errors->has('name') ? 'has-error':''}}"> 
                        <label for="name">Identificador:</label>
                        @if ($role->exists)
                        <input type="text"  class="form-control" value="{{$role->name}}" disabled>   
                        @else
                        <input type="text" name="name"  class="form-control" value="{{ old('name', $role->name)}}" > 
                        {!!$errors->first('name','<span class="help-block">:message</span>')!!}
                        @endif
                    </div>

                    <div class="form-group {{$errors->has('display_name') ? 'has-error':''}}"> 
                        <label for="display_name">Nombre:</label>
                        <input type="text" name="display_name" class="form-control" value="{{old('display_name',$role->display_name)}}">
                        {!!$errors->first('display_name','<span class="help-block">:message</span>')!!}
                    </div>

                    {{-- <div class="form-group {{$errors->has('email') ? 'has-error':''}}"> 
                        <label for="name">Guard:</label>
                        
                        <select name="guard_name" class="form-control">
                            @foreach (config('auth.guards') as $guardName => $guard)
                                    <option {{old('guard_name', $role->guard_name) === $guardName ? 'selected' : ''}} value="{{$guardName}}">{{$guardName}}</option>
                            @endforeach
                        </select>
                        {!!$errors->first('email','<span class="help-block">:message</span>')!!}
                    </div> --}}

                    <div class="form-group col-md-6">
                        <label>Permisos</label>
                        @include('admin.permissions.checkboxes',['model' => $role]) 
                    </div>