@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <!-- <div class="font-medium text-red-600">
            {{-- {{ __('Whoops! Something went wrong.') }} --}}
        </div> -->
            <pre><?php var_dump($error); ?></pre>
            {{-- <pre><?php var_dump($telSumMes); ?></pre> --}}
        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li style="list-style:none">{{ $error }}</li>
            @endforeach
            @if (session('errorr') && empty($errors))
            <span class="text-sm text-red-600">
                {{ session('error') }}
            </span>
            @endif
        </ul>
    </div>
@endif
