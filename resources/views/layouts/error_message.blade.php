@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="m-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="w-100 rounded-sm p-2 text-white" x-bind:class="$store.global.flashClass" x-show="$store.global.isFlash">
    <ul class="mb-0">
        <template x-for="(value, index) in $store.global.flashData">
            <li x-text="value"></li>
        </template>
    </ul>
</div>