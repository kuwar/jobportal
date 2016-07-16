<div class="container">
    <div class="row">
        @if($errors->any())
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;
                </button>
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            <hr>
        @endif

        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;
                </button>
                {{ Session::get('success') }}
            </div>
        @endif

        @if(Session::has('info'))
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;
                </button>
                {{ Session::get('info') }}
            </div>
        @endif

        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;
                </button>
                {{ Session::get('error') }}
            </div>
        @endif

        @if(Session::has('warning'))
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;
                </button>
                {{ Session::get('warning') }}
            </div>
        @endif
    </div>
</div>