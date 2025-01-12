<div class="" style="margin-left: 30px">
    <a data-toggle="collapse" data-target="#collapse-{{ $cate->id }}" aria-expanded="true"
        aria-controls="collapse-{{ $cate->id }}">
        {{-- @if (count($cate->children) > 0)
            <i class="fa fa-plus" aria-hidden="true"></i>
        @endif --}}
    </a>
    <input type="radio" class="form-check-input" id="{{ $cate->id }}" name="parent_id" value="{{ $cate->id }}"
        @if (isset($category) && $cate->id == $category->parent_id) checked @endif>
    <label for="{{ $cate->id }}">{{ $cate->name }}</label>
    <div class="sub-cat-scroll">
        @foreach ($cate->children as $subcategory)
            @if (isset($category))
                @if ($category->id != $subcategory->id)
                    <x-utility.category.category :cate="$subcategory" :category="$category" />
                @endif
            @else
                <x-utility.category.category :cate="$subcategory" />
            @endif
        @endforeach
    </div>
</div>
