<x-auth-layout>

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-0">Criar Nova Task</h3>
                <small class="text-muted">Adicione uma nova tarefa ao sistema</small>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Houve um erro ao criar a task: </strong>

                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form method="POST" action="{{ route('tasks.create.submit') }}">
                    @csrf

                    {{-- nome --}}
                    <div class="mb-3">
                        <label class="form-label">Nome da Task</label>

                        <input type="text" name="name" class="form-control" placeholder="Ex: Finalizar relatório" value="{{ old('name') }}">
                    </div>

                    {{-- descrição --}}
                    <div class="mb-3">
                        <label class="form-label">
                            Descrição
                        </label>

                        <textarea name="description" rows="4" class="form-control" placeholder="Descreva a tarefa (opcional)">{{ old('description') }}</textarea>
                    </div>

                    {{-- categoria --}}
                    <label class="form-label">
                        Categoria
                    </label>

                    <div class="input-group">
                        <select name="category_id" class="form-select">

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>

                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#newCategory"><i class="far fa-plus me-2"></i>Criar categoria</button>
                    </div>

                    {{-- urgencia --}}
                    <div class="mb-4">

                        <label class="form-label d-block">
                            Urgência
                        </label>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="urgency" id="urgencyLow" value="low"@checked(old('urgency') == 'low')>

                            <label class="form-check-label text-success" for="urgencyLow">Baixa</label>
                        </div>


                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="urgency" id="urgencyMedium" value="medium"@checked(old('urgency') == 'medium')>

                            <label class="form-check-label text-warning" for="urgencyMedium">Média</label>
                        </div>


                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="urgency" id="urgencyHigh" value="high"@checked(old('urgency') == 'high')>

                            <label class="form-check-label text-danger" for="urgencyHigh">Alta</label>
                        </div>
                    </div>

                    {{-- botões --}}
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left me-2"></i>Cancelar</a>

                        <button class="btn btn-success"><i class="fa-solid fa-check me-2"></i>Salvar Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <div class="modal fade" id="newCategory">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('create.category.submit') }}">

                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Nova Categoria</h5>
                    </div>

                    <div class="modal-body">
                        <input type="text" name="name" class="form-control" placeholder="Nome da categoria" required>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <button class="btn btn-primary">
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>
