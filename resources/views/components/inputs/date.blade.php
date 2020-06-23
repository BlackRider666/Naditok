<input type="date" class="form-control {{$errors->has($name) ? 'is-invalid':''}}" id="{{$name}}" name="{{$name}}" value="{{$value?:now()->format('Y-m-d')}}">
