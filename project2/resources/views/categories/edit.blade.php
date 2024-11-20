<x-master>
    <style>
        /* Your CSS styles here */
    </style>
    <div>
        <h2 class="text-white">Edit Category</h2>
        <form action="{{ route('categories.update', $data['category']->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="text-white" for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $data['category']->name }}" required>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="text-white" for="time">Time:</label>
                <input type="datetime-local" id="time" name="time" class="form-control" value="{{ $data['category']->time }}" required>
                @error('time')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</x-master>