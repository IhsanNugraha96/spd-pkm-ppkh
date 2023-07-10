<div style="margin-top:20px;">
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" style="display:none" data-dismiss="alert" id="closeBtn"
            aria-label="Close"><span aria-hidden="true">×</span></button>
            {{session()->get('success')}}
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