<div>
  <!-- if any validation errors are found -->
  @if ($errors->any())
    <ul class="p-3 bg-danger bg-opacity-10 list-unstyled">
      <!-- loop through errors -->
      @foreach ($errors->all() as $error)
       <!-- display errors -->
        <li class="my-2 text-danger">{{ $error }}</li>
      @endforeach
    </ul>
  @endif
  <!-- form  -->
  <form action="{{ route('tasks.create') }}" method="POST" class="task-form">
    <!-- include cross site request forgery  -->
    @csrf

    <div class="form-group">
      <input type="text" id="task" name="task" class="form-control task-input" placeholder="Insert task name" aria-label="User input">
      <button class="btn btn-primary task-button" type="submit">Add</button>
    </div>
  </form>
</div>