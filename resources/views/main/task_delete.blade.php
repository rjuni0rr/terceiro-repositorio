<x-auth-layout>

    <div class="container py-4">

        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="card shadow border-danger">

                    <div class="card-header bg-danger text-white">
                        Confirmar exclusão
                    </div>

                    <div class="card-body text-center">

                        <h5 class="mb-3">
                            Tem certeza que deseja excluir esta task?
                        </h5>

                        <p class="text-muted">
                            <strong>{{ $task->name }}</strong>
                        </p>

                        <div class="d-flex justify-content-center gap-3 mt-4">

                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                                Cancelar
                            </a>

                            <form method="POST" action="{{ route('tasks.delete.confirm', Crypt::encrypt($task->id)) }}">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger">
                                    Sim, excluir
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-auth-layout>
