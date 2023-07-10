<div style="margin-top:20px;">
    <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" id="closeBtn" style="display:none" data-dismiss="alert"
            aria-label="Close"><span aria-hidden="true">×</span></button>
        {{session()->get('info')}}
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        setTimeout(function () {
            $('#closeBtn').trigger('click');
        }, 5000);
    });
</script>
@endpush