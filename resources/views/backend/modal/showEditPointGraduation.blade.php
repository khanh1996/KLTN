<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Nhập điểm</h4>
</div>
<form action="{{route('backend.graduation.point',$graduation)}}" method="POST" enctype="multipart/form-data">
    {{ method_field('PATCH') }}
    {{ csrf_field() }}
    <div class="modal-body">
        <div class="form-group">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <td>Chức vụ</td>
                    <td>Họ tên</td>
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
                                    <input type="number" min="0" max="10" class="form-control" name="pointPresident" value=""  placeholder="Nhập số" required="">
                                @endif
                                @if( $value->position == 'commissary')
                                    <input type="number" min="0" max="10" class="form-control" name="pointCommissary" value="" placeholder="Nhập số" required="">
                                @endif
                                @if( $value->position == 'secretary')
                                    <input type="number" min="0" max="10" class="form-control" name="pointSecretary" value="" placeholder="Nhập số" required="">
                                @endif
                                @if( $value->position == 'reviewer')
                                    <input type="number" min="0" max="10" class="form-control" name="pointReviewer" value="" placeholder="Nhập số" required="">
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </div>
</form>