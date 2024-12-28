<label for="{{$name}}" class="form-label">{{$label}}</label>
<select name="{{$name}}" class="form-select">
    <option value="-" selected disabled>--Pilih--</option>
    {{$slot}}
</select>