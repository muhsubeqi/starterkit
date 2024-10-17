<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full py-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-1">
                    {{ $title }}
                </h1>
                @if($subtitle)
                    <small class="fw-medium text-muted mb-0 mt-0">
                        {{ $subtitle }}
                    </small>
                @endif
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    @foreach ($breadcrumbs as $breadcrumb)
                        <li class="breadcrumb-item">
                            @if (isset($breadcrumb['url']))
                                <a class="link-fx" href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
                            @else
                                {{ $breadcrumb['label'] }}
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->
