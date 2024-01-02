@if(session('success'))
 <div class="alert alert-succsess">{{session('success')}}</div>
@endif

@if(session('info'))
 <div class="alert alert-info">{{session('info')}}</div>
@endif

@if(session('success'))
 <div class="alert alert-danger">{{session('danger')}}</div>
@endif