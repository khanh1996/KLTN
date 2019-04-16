<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Chi tiết</h4>
</div>
<div class="modal-body text-export-post">
    <span>
        {!! !empty($subject->detail) ? $subject->detail : 'Chưa có mô tả' !!}
    </span>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Close</button>
</div>
