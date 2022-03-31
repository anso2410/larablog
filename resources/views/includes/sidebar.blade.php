<div class="my-4">Catégories</div>
<div class="list-group">

@foreach(App\Models\Category::get() as $category)
<a href="#" class="list-group-item">{{ $category->name }}</a>
@endforeach
</div>