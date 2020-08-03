<div class="multi-select-dropdown">
    <div class="dheader" data-status="closed">
        <span class="select-default">{{ $label }}</span>
        <span class="sort-arrow">
            <i class="fa fa-caret-down"></i>
        </span>
    </div>
    <div class="dropdown-body">
        @if(is_array($items))
            @foreach($items as $item)
                @php $selected = $item->selected ?? 'inactive' @endphp
                <div class="msw">
                    <div class="checkbox-wrap {{ $selected }} {{ $selector }}" data-status="{{ $selected }}" data-id="{{ $item->id }}">
                        <div class="checkmark-box"></div>
                        <span class="checkmark">
                            <i class="fa fa-check"></i>
                        </span>
                    </div>
                    <div class="mswtitle">{{ $item->label }}</div>
                </div>
            @endforeach
        @endif
    </div>
</div>