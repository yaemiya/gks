@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            <?=dd($errors=);?>
            @foreach ($errors->all() as $error)
                <li style="list-style:none">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
