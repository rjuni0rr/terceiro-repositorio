<x-auth-layout>

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-0">Gerenciamento de Tasks</h3>
                <small class="text-muted">Organize suas tarefas</small>
            </div>

            <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                + Nova Task
            </a>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Total Tasks</h6>

                        <h3>{{ $tasks->count() }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Alta urgência</h6>

                        <h3 class="text-danger">{{ $tasks->where('urgency','high')->count() }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Média urgência</h6>

                        <h3 class="text-warning">{{ $tasks->where('urgency','medium')->count() }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Baixa urgência</h6>

                        <h3 class="text-success">{{ $tasks->where('urgency','low')->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>


        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">

                <h5 class="mb-0">Lista de Tasks</h5>

            </div>
            <div class="card-body">
                <table id="tasksTable" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Task</th>
                            <th>Categoria</th>
                            <th>Urgência</th>
                            <th>Criada</th>
                            <th width="150">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>
                                <strong>{{ $task->name }}</strong>
                                @if($task->description)
                                    <br>
                                    <small class="text-muted">{{ Str::limit($task->description,40) }}</small>
                                @endif
                            </td>

                            <td>
                                <span class="badge bg-secondary">{{ $task->category->name }}</span>
                            </td>

                            <td>
                                @if($task->urgency == 'low')
                                    <span class="badge bg-success">Baixa</span>
                                @endif

                                @if($task->urgency == 'medium')
                                    <span class="badge bg-warning text-dark">Média</span>
                                @endif

                                @if($task->urgency == 'high')
                                        <span class="badge bg-danger">Alta</span>
                                @endif
                            </td>

                            <td>{{ $task->created_at->format('d/m/Y') }}</td>

                            <td>
                                <a href="{{ route('tasks.edit',$task->id) }}" class="btn btn-sm btn-outline-warning">
                                    Editar
                                </a>

                                <form action="{{ route('tasks.destroy',$task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#tasksTable').DataTable({
                pageLength: 10,
                language: {
                    search: "Buscar:",
                    lengthMenu: "Mostrar _MENU_ registros",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ tasks",
                    paginate: {
                        next: "Próximo",
                        previous: "Anterior"
                    }
                }
            });
        });
    </script>
</x-auth-layout>
