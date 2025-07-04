<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MLP To-Do</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
</head>
<x-header />
<body>
    <!-- if success message is passed -->
    @if (session('success'))
        <!-- show success message -->
        <div id="flash" class="p-3 text-center bg-success bg-opacity-10 text-success fw-bold">
        {{ session('success') }}
        </div>
    @endif

    <div class="container mt-4">
        <!-- keep everything in one row -->
        <div class="row">
            <!-- form in left column -->
            <div class="col-md-4">
                <!-- form component -->
                <x-form />
            </div>

            <!-- table in right column -->
            <div class="col-md-8"> 
            <!-- table -->
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Task</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- loop through task data -->
                    @foreach ($data as $task)
                        <!-- start row -->
                        <tr>
                            <!-- id cell -->
                            <td>{{ $task->id }}</td>
                            <!-- task cell - if complete is set (true/false) then put line through -->
                            <td @if($task->completed !== null) style="text-decoration: line-through; color: gray;" @endif>
                                {{ $task->task }}
                            </td>
                            <!-- buttons cell -->
                            <td>
                                <!-- if complete is null -->
                                @if ($task->completed === null)
                                    <!-- show buttons -->

                                    <!-- form to mark as complete -->
                                    <form action="{{ route('tasks.update', ['id' => $task->id]) }}" method="POST" style="display: inline;">
                                        <!-- include cross site request forgery  -->
                                        @csrf
                                        <!-- hidden input lable to store value  -->
                                        <input type="hidden" name="status" value="true" />
                                        <!-- button to submit form  -->
                                        <button type="submit" class="btn btn-success btn-sm" title="Mark as complete">&#10003;</button>
                                    </form>

                                    <!-- form to delete -->
                                    <form action="{{ route('tasks.delete', ['id' => $task->id]) }}" method="POST" style="display: inline;">
                                        <!-- include cross site request forgery  -->
                                        @csrf
                                        <!-- button to submit form  -->
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Task">&#10007;</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
<x-footer />
</html>
