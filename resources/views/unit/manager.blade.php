<x-app-layout>
    @foreach ($unitsWithIcons as $unit)
        <div class="unit-item">
            <h4>{{ $unit['name'] }}</h4>
            <p>Status: {{ $unit['enabled'] ? 'Enabled' : 'Disabled' }}</p>

            @if ($unit['enabled'])
                <form action="{{ route('unit.disable', $unit['name']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Disable</button>
                </form>
            @else
                <form action="{{ route('unit.enable', $unit['name']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Enable</button>
                </form>
            @endif
        </div>
    @endforeach
</x-app-layout>