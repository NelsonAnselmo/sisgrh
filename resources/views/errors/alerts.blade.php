@if ($errors->any())
    <div class="alert toasts-top-right fixed">
        <div class="toast bg-danger fade show" role="alert" aria-live="polite" aria-atomic="true">
            <div class="toast-header"><strong class="mr-auto"><i class="fa fa-times"></i> Erro</strong>
                <small></small>
                <button data-dismiss="alert" type="button" class="ml-2 mb-1 close" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        </div>
    </div>


@endif

@if (session('success'))
    <div class="alert toasts-top-right fixed">
        <div class="toast bg-success fade show" role="alert" aria-live="polite" aria-atomic="true">
            <div class="toast-header"><strong class="mr-auto"><i class="fas fa-check"></i> Sucesso</strong>
                <small></small>
                <button data-dismiss="alert" type="button" class="ml-2 mb-1 close" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body">{{ session('success') }}.</div>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="alert toasts-top-right fixed">
        <div class="toast bg-danger fade show" role="alert" aria-live="polite" aria-atomic="true">
            <div class="toast-header"><strong class="mr-auto"><i class="fa fa-times"></i> Erro</strong>
                <small></small>
                <button data-dismiss="alert" type="button" class="ml-2 mb-1 close" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body">{{ session('error') }}.</div>
        </div>
    </div>
@endif
