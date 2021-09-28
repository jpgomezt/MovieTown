@if ($message = Session::get('message'))
    <div class="alert alert-dark alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ __('message.' . $message) }}</strong>
    </div>
@endif
