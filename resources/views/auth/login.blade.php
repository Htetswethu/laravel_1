<x-layout>

    <form action="/login" method="POST">
        @csrf
        <div>
            <label for="">Email</label>
            <input type="email" name="email" value="{{old('email')}}">
            @error('email')
                <p class="text-danger">
                    {{$message}}
                </p>
            @enderror
        </div>
        <div>
            <label for="">Password</label>
            <input type="password" name="password">
            @error('password')
                <p class="text-danger">
                    {{$message}}
                </p>
            @enderror
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</x-layout>