<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Chi tiết</h4>
</div>
<div class="modal-body">
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <td>Khóa</td>
            <td>Kỳ</td>
            <td>Nhóm</td>
            <td>Phòng</td>
            <td>Thời gian</td>
            <td>Năm</td>
        </tr>
        </thead>
        <tbody>
        @if(!empty($graduation))
        <tr>
            <td>{{ !empty($graduation->userStudent->course ) ? $graduation->userStudent->course : ''}}</td>
            <td>
                @if($graduation->semester == 1) {{'Kỳ I'}} @endif
                @if($graduation->semester == 2) {{'Kỳ II'}} @endif
                @if($graduation->semester == 3) {{'Kỳ III'}} @endif
            </td>
            <td>
                {{ !empty($graduation->userStudent->group ) && $graduation->userStudent->group == 1  ? 'Nhóm '.$graduation->userStudent->group : ''}}
                {{ !empty($graduation->userStudent->group ) && $graduation->userStudent->group == 2  ? 'Nhóm '.$graduation->userStudent->group : ''}}
                {{ !empty($graduation->userStudent->group ) && $graduation->userStudent->group == 3  ? 'Nhóm '.$graduation->userStudent->group : ''}}
            </td>
            <td>{{ !empty($graduation->room) ? $graduation->room : ''}}</td>
            <td>{{!empty($graduation->time) ? Carbon\Carbon::parse($graduation->time)->format('d/m/Y h:i A') : ''}}</td>
            <td>{{ !empty($graduation->year->name) ? $graduation->year->name : ''}}</td>
        </tr>
        @endif
        </tbody>
    </table>
    <h4 class="modal-title" style="margin-bottom: 10px">Hội đồng : {{!empty($assembly->name) ? $assembly->name : ''}}</h4>
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
                            {{$graduation->pointPresident}}
                        @endif
                        @if($value->position == 'commissary')
                            {{$graduation->pointCommissary}}
                        @endif
                        @if($value->position ==  'secretary')
                            {{$graduation->pointSecretary}}
                        @endif
                        @if($value->position == 'reviewer')
                            {{$graduation->pointReviewer}}
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Close</button>
</div>