@foreach ($subcategories as $sub)
    <option value="{{ $sub->id }}">{{ $parent}} -> {{ $sub->category_name }}</option>

    @if (count($sub->childs) > 0)
        @php
            // Creating parents list separated by ->.
            $parents = $parent . '->' . $sub->category_name;
        @endphp
        @include('sub_category_list', ['subcategories' => $sub->childs, 'parent' => $parents])
    @endif
@endforeach