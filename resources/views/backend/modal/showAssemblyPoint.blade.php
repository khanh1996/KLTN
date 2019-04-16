<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <td>Chức vụ</td>
        <td>Họ và tên</td>
        <td>Trọng số</td>
        <td>Điểm</td>
    </tr>
    </thead>
    <tbody>
    @if(!empty($assembly->assemblys_users))
        @foreach($assembly->assemblys_users as $value)
            <tr>
                <td>
                    {{config('assembly.position.'.$value->position)}}
                </td>
                <td>{{$value->users->name}}</td>
                <td>{{$value->weight}}%</td>
                <td>
                    @if($value->position == 'president')
                        <input type="number" min="0" max="10" class="form-control" name="pointPresident" value="{{$graduation->assembly_id == $assembly->id ? $graduation->pointPresident : ''}}"  placeholder="Nhập số" required="">
                    @endif
                    @if( $value->position == 'commissary')
                        <input type="number" min="0" max="10" class="form-control" name="pointCommissary" value="{{$graduation->assembly_id == $assembly->id ? $graduation->pointCommissary : ''}}" placeholder="Nhập số" required="">
                    @endif
                    @if( $value->position == 'secretary')
                        <input type="number" min="0" max="10" class="form-control" name="pointSecretary" value="{{$graduation->assembly_id == $assembly->id ? $graduation->pointSecretary : ''}}" placeholder="Nhập số" required="">
                    @endif
                    @if( $value->position == 'reviewer')
                        <input type="number" min="0" max="10" class="form-control" name="pointReviewer" value="{{$graduation->assembly_id == $assembly->id ? $graduation->pointReviewer : ''}}" placeholder="Nhập số" required="">
                    @endif
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>