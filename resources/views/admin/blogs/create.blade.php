<x-admin-layout>
    <form action="/admin/blogs/store" method="POST">
      @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Blog title</label>
          <input name="title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">         
        </div>
        @error('title')
                <p class="text-danger">
                    {{$message}}
                </p>
        @enderror
        <div class="form-group">
          <label for="exampleInputEmail1">Blog intro</label>
          <input name="intro" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">         
        </div>
        @error('intro')
                <p class="text-danger">
                    {{$message}}
                </p>
        @enderror
        <div class="form-group">
          <label for="exampleInputEmail1">Blog slug</label>
          <input name="slug" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">         
        </div>
        @error('slug')
                <p class="text-danger">
                    {{$message}}
                </p>
        @enderror
        <div class="form-group">
          <label for="exampleInputEmail1">Blog body</label>
          <textarea name="body" id="" cols="30" rows="10" class="form-control">
            </textarea>         
        </div>
        @error('body')
                <p class="text-danger">
                    {{$message}}
                </p>
        @enderror
        <div class="form-group">
          <label for="exampleInputEmail1">Blog category</label>
          <select name="category_id" id="" class="form-control">
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
                
            @endforeach
          </select>
          @error('category')
                <p class="text-danger">
                    {{$message}}
                </p>
          @enderror
        </div>

        <div class="my-3">
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
      </form>
</x-admin-layout>