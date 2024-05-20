@props(['blogs'])
<section class="container text-center" id="blogs">
    <h1 class="display-5 fw-bold mb-4">Blogs</h1>
    <x-category></x-category>
    <form action="" class="my-3">
      @if(request('author'))
          <input type="hidden"
          name="author"
          value="{{request('author')}}">
      @endif
      @if(request('category'))
          <input type="hidden"
          name="category"
          value="{{request('category')}}">
      @endif

      {{-- input type hidden --}}
      <div class="input-group mb-3">
        <input
          value="{{request('search')}}"
          type="text"
          name="search"
          autocomplete="false"
          class="form-control"
          placeholder="Search Blogs..."
        />
        <button
          class="input-group-text bg-primary text-light"
          id="basic-addon2"
          type="submit"
        >
          Search
        </button>
      </div>
    </form>
    <div class="row">
          @forelse ($blogs as $blog)
          <div class="col-md-4 mb-4">
              <x-blog-card :blog='$blog'/>
          </div>   
          @empty 
          <p style="color: red">No search result found.</p> 
          @endforelse  
          {{$blogs->links()}}                 
    </div>
  </section>