<div class="my-4">Catégories</div>
<div class="list-group">

@foreach(App\Models\Category::has('articles')->get() as $category)
<a href="{{ route('category.show', ['category'=>slug]) }}" class="list-group-item">{{ $category->name }}</a>
@endforeach
</div>