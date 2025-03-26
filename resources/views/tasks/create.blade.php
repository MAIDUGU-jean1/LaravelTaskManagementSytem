<x-layout>
    <html>
        <head>
            <title>Task Management </title>
        </head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <body>
           
            
            <div class="container mt-4">
                <h1 class="mb-4">Create New Task</h1>

                <form method="POST" action="{{ route('store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="title">Task Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="description">Task Description (optional)</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $task->description ?? '') }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="status">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tag" class="form-label">Tag</label>
                        <select class="form-control" name="tag" id="tag">
                            <option value="">Select Tag</option>
                            <option value="urgent">Urgent</option>
                            <option value="work">Work</option>
                            <option value="home">Home</option>
                            <option value="personal">Personal</option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="due_date">Due Date (optional)</label>
                        <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date') }}">
                        @error('due_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Create Task</button>
                    </div>
                </form>
            </div>

        </body>
    </html>
</x-layout>
