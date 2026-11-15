@if ($paginator->total() > 0)
<div class="p-3 px-4 border-top d-flex flex-wrap justify-content-between align-items-center gap-3 bg-white w-100">
  {{-- Left Side: Per Page Selector & Total Rows --}}
  <div class="d-flex align-items-center gap-2 text-muted small">
    <span>Menampilkan</span>
    <select class="form-select form-select-sm" style="width: auto; display: inline-block; padding: 3px 26px 3px 10px; font-size: 12.5px; font-weight: 600; border-radius: 8px; border-color: #cbd5e1; cursor: pointer; background-color: #ffffff; color: #1e293b;" onchange="changeTablePerPage(this)">
      @foreach([5, 10, 15, 25, 50, 100] as $size)
        <option value="{{ $size }}" {{ $paginator->perPage() == $size ? 'selected' : '' }}>{{ $size }}</option>
      @endforeach
    </select>
    <span>dari {{ number_format($paginator->total(), 0, ',', '.') }} baris</span>
  </div>

  {{-- Right Side: Range & Navigation Links --}}
  <div class="d-flex align-items-center gap-3 ms-auto flex-wrap">
    <span class="text-muted small">
      {{ $paginator->firstItem() ?? 0 }}-{{ $paginator->lastItem() ?? 0 }} dari {{ number_format($paginator->total(), 0, ',', '.') }}
    </span>

    @if ($paginator->hasPages())
    <nav aria-label="Navigasi Halaman">
      <ul class="pagination pagination-sm mb-0 align-items-center gap-1" style="list-style: none; padding-left: 0;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
          <li class="page-item disabled" aria-disabled="true">
            <span class="page-link border-0 text-muted" style="background: transparent; padding: 4px 8px; cursor: not-allowed; font-size: 14px;">&lsaquo;</span>
          </li>
        @else
          <li class="page-item">
            <a class="page-link border-0" href="{{ $paginator->previousPageUrl() }}" rel="prev" style="color: #334155; background: transparent; padding: 4px 8px; font-size: 14px;" title="Halaman Sebelumnya">&lsaquo;</a>
          </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
          {{-- "Three Dots" Separator --}}
          @if (is_string($element))
            <li class="page-item disabled" aria-disabled="true">
              <span class="page-link border-0 text-muted" style="background: transparent; padding: 4px 6px; font-size: 13px;">{{ $element }}</span>
            </li>
          @endif

          {{-- Array Of Links --}}
          @if (is_array($element))
            @foreach ($element as $page => $url)
              @if ($page == $paginator->currentPage())
                <li class="page-item active" aria-current="page">
                  <span class="page-link fw-bold text-white shadow-sm" style="background: #0056b3; border: 1px solid #0056b3; border-radius: 8px; min-width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; padding: 0 8px; font-size: 12.5px;">{{ $page }}</span>
                </li>
              @else
                <li class="page-item">
                  <a class="page-link border-0 text-dark fw-semibold" href="{{ $url }}" style="background: transparent; border-radius: 8px; min-width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; padding: 0 8px; font-size: 12.5px; transition: background 0.15s;">{{ $page }}</a>
                </li>
              @endif
            @endforeach
          @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
          <li class="page-item">
            <a class="page-link border-0" href="{{ $paginator->nextPageUrl() }}" rel="next" style="color: #334155; background: transparent; padding: 4px 8px; font-size: 14px;" title="Halaman Selanjutnya">&rsaquo;</a>
          </li>
        @else
          <li class="page-item disabled" aria-disabled="true">
            <span class="page-link border-0 text-muted" style="background: transparent; padding: 4px 8px; cursor: not-allowed; font-size: 14px;">&rsaquo;</span>
          </li>
        @endif
      </ul>
    </nav>
    @endif
  </div>
</div>
<script>
if (typeof changeTablePerPage === 'undefined') {
  function changeTablePerPage(el) {
    var url = new URL(window.location.href);
    url.searchParams.set('per_page', el.value);
    url.searchParams.set('page', '1');
    try { localStorage.setItem('table_per_page', el.value); } catch(e){}
    window.location.href = url.toString();
  }
}
</script>
@endif
