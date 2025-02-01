@foreach ($modulesWithStatus as $module)
    <div class="module-item">
        <h4>{{ $module['name'] }}</h4>
        <p>Status: {{ $module['enabled'] ? 'Enabled' : 'Disabled' }}</p>

        @if ($module['enabled'])
            <form action="{{ route('module.disable', $module['name']) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Disable</button>
            </form>
        @else
            <form action="{{ route('module.enable', $module['name']) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Enable</button>
            </form>
        @endif
    </div>
@endforeach