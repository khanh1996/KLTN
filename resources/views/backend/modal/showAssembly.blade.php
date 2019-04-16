<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="title_assembly">@if(!empty($assembly)){{$assembly->name}}@endif
    </h4>
</div>
<div class="modal-body">
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <td>Chức vụ</td>
            <td>Họ và tên</td>
            <td>Trọng số</td>
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
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Close</button>
</div>