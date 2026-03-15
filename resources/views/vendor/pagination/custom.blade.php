@if ($paginator->hasPages())

<nav>
<ul class="pagination">

{{-- Previous Page --}}
@if ($paginator->onFirstPage())
<li class="disabled"><span>Previous</span></li>
@else
<li>
<a href="{{ $paginator->previousPageUrl() }}">Previous</a>
</li>
@endif


{{-- Page Numbers --}}
@foreach ($elements as $element)

@if (is_string($element))
<li class="disabled">{{ $element }}</li>
@endif

@if (is_array($element))
@foreach ($element as $page => $url)

@if ($page == $paginator->currentPage())
<li class="active"><span>{{ $page }}</span></li>
@else
<li><a href="{{ $url }}">{{ $page }}</a></li>
@endif

@endforeach
@endif

@endforeach


{{-- Next Page --}}
@if ($paginator->hasMorePages())
<li>
<a href="{{ $paginator->nextPageUrl() }}">Next</a>
</li>
@else
<li class="disabled"><span>Next</span></li>
@endif

</ul>
</nav>

@endif