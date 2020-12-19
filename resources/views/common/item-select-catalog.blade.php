@foreach($subcategories as $subcategory)
    <option value="{{ $subcategory->id }}" @if ($selected == $subcategory->id) selected @endif  >@for ($i = 0; $i < $level; $i++)|--@endfor {{ $subcategory->title }}</option>
    @if(count($subcategory->subcategory))
        @include('common.item-select-catalog',['subcategories' => $subcategory->subcategory, 'level' => $level+1])
    @endif
@endforeach