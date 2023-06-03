@auth
    <x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
    >

    <x-sidebar.link
        title="Dashboard"
        href="{{ route('dashboard') }}"
        :isActive="request()->routeIs('dashboard')"
    >
        <x-slot name="icon">
            <i class="fas fa-tachometer"></i>
        </x-slot>
    </x-sidebar.link>
    @if (Auth::user()->rol_id == 1)
    <x-sidebar.link
        title="Pacientes"
        href="{{ route('pacientes.index') }}"
        :isActive="request()->routeIs('pacientes.index')"
    >
        <x-slot name="icon">
            <i class="fa-solid fa-hospital-user w-6 h-6"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link
        title="Doctores"
        href="{{ route('doctores.index') }}"
        :isActive="request()->routeIs('doctores.index')"
    >
        <x-slot name="icon">
            <i class="far fa-users-medical"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link
        title="Prepagas"
        href="{{ route('prepagas.index') }}"
        :isActive="request()->routeIs('prepagas.index')"
    >
        <x-slot name="icon">
            <i class="far fa-users-medical"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link
        title="Turnos"
        href="{{ route('turnos.index') }}"
        :isActive="request()->routeIs('turnos.index')"
    >
        <x-slot name="icon">
            <i class="far fa-users-medical"></i>
        </x-slot>
    </x-sidebar.link>

    @elseif (Auth::user()->rol_id == 3)
    <x-sidebar.link
        title="Historial de Turnos"
        href="{{route('paciente.historial')}}"
        :isActive="request()->routeIs('paciente.historial')"
    >
        <x-slot name="icon">
            <i class="far fa-users-medical"></i>
        </x-slot>
    </x-sidebar.link>
    @endif

    </x-perfect-scrollbar>
@endauth


