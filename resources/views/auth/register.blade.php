<x-guest-layout>

    <h3 class="text-center mb-4">
        Criar Conta
    </h3>

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form method="POST" action="/register">

        @csrf

        <div class="mb-3">

            <label>Nome</label>

            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name') }}"
                required
            >

        </div>

        <div class="mb-3">

            <label>Email</label>

            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                required
            >

        </div>

        <div class="mb-3">

            <label>Senha</label>

            <input
                type="password"
                name="password"
                class="form-control"
                required
            >

        </div>

        <div class="mb-3">

            <label>Confirmar Senha</label>

            <input
                type="password"
                name="password_confirmation"
                class="form-control"
                required
            >

        </div>

        <div class="d-grid">

            <button class="btn btn-success">
                Registrar
            </button>

        </div>

    </form>

    <div class="text-center mt-3">

        <a href="/login">
            Já tenho conta
        </a>

    </div>

</x-guest-layout>
