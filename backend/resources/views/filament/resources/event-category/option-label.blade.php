<div class="flex justify-between">
    <div>
        {{$category->name}}
    </div>
    @if($category->parent)
    <div>
        in {{$category->parent->name}}
    </div>
        @endif
</div>
