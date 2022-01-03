@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <!-- <div class="font-medium text-red-600">
            {{-- {{ __('Whoops! Something went wrong.') }} --}}
        </div> -->
        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li style="list-style:none">{{ $error }}</li>
            @endforeach
        </ul>
            @if (session('error'))
            <span class="text-sm text-red-600">
                {{ session('error') && empty($errors)}}
            </span>
            @endif
    </div>
@endif
