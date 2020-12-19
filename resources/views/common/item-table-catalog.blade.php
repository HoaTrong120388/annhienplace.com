@foreach($subcategories as $item)
    <tr class="intro-x">
        <td>{{ $item->id }}</td>
        <td title="{{ $item->title }}">@for ($i = 0; $i < $level; $i++)| ------ @endfor {{ Str::limit($item->title, 100, '...') }}</td>
        <td>@if ($item->status == 1)<span class="text-theme-1">Hiện</span>@else<span class="text-theme-6">Ẩn</span>@endif</td>
        <td class="text-center">
            <div class="flex justify-center items-center">
                <a class="flex items-center mr-3" href="{{ URL::route("admin.$strControler.todo", ['id' => $item->id] ) }}"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                <a class="flex items-center text-theme-6" onclick="confirm_delete('{{ URL::route("admin.$strControler.delete", ['id' => $item->id] ) }}')" href="javascript:void(0);" > <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
            </div>
        </td>
    </tr>
    @if(count($item->subcategory))
        @include('common.item-table-catalog',['subcategories' => $item->subcategory, 'level' => $level+1])
    @endif
@endforeach