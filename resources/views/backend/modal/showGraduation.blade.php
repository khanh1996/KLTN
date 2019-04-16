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
            <td>Năm</td>
        </tr>
        </thead>
        <tbody>
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
            <td>{{ !empty($graduation->year->name) ? $graduation->year->name : ''}}</td>
        </tr>
        </tbody>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Close</button>
</div>