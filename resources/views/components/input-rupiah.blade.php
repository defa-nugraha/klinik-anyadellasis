<label for="{{$name}}" class="form-label">{{$label}}</label>
<input onKeyup="format(this)" type="{{$type}}" value="{{$value}}" class="form-control" id="{{$name}}" name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">

<x-_formatRupiah/>