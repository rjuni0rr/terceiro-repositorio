<x-auth-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-0">Editar Task</h3>
                <small class="text-muted">Atualize as informações da tarefa</small>
            </div>

            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-2"></i>Voltar
            </a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <form method="POST" action="{{ route('tasks.edit.submit', Crypt::encrypt($task->id)) }}">
                    @csrf
                    @method('PUT')

                    {{-- nome --}}
                    <div class="mb-3">
                        <label class="form-label">Nome da Task</label>

                        <input type="text" name="name" class="form-control" value="{{ old('name',$task->name) }}">
                    </div>

                    {{-- descrição --}}
                    <div class="mb-3">
                        <label class="form-label">Descrição</label>

                        <textarea name="description" rows="4" class="form-control">{{ old('description',$task->description) }}</textarea>
                    </div>

                    {{-- categoria --}}
                    <div class="mb-3">
                        <label class="form-label">Categoria</label>

                        <div class="input-group">
                            <select name="category_id" class="form-select">
                                <option value="">Sem categoria</option>

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if(old('category_id',$task->category_id) == $category->id) selected @endif>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#newCategory"><i class="far fa-plus me-2"></i>Criar categoria</button>
                        </div>
                    </div>

                    {{-- urgencia --}}
                    <div class="mb-4">
                        <label class="form-label d-block">Urgência</label>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="urgency" value="low"@checked(old('urgency',$task->urgency) == 'low')>

                            <label class="form-check-label text-success">Baixa</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="urgency" value="medium"@checked(old('urgency',$task->urgency) == 'medium')>

                            <label class="form-check-label text-warning">Média</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="urgency" value="high"@checked(old('urgency',$task->urgency) == 'high')>

                            <label class="form-check-label text-danger">Alta</label>
                        </div>
                    </div>

                    {{-- botões --}}
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-2"></i>Cancelar</a>
                        <button class="btn btn-primary"><i class="fa-solid fa-check me-2"></i>Atualizar Task</button>
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
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>
