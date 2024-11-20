<x-master>
    <style>
        /* Your CSS styles here */
    </style>
    <div>
        <h2 class="text-white">Create New Category</h2>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="text-white" for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="text-white" for="time">Time:</label>
                <input type="datetime-local" id="time" name="time" class="form-control" required>
                @error('time')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary ">Create</button>
        </form>
    </div>
</x-master>