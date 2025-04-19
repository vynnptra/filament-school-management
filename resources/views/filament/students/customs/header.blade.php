<div>

    <x-filament::breadcrumbs :breadcrumbs="[
        '/admin/student' => 'Student',
        '' => 'List',
    ]" />
    
    <div class="flex justify-between mt-1">
        <div class="font-bold text-3xl">Students</div>
            <div>
                {{ $data }}
            </div>
        </div>
    
        <div>
            <form wire:submit.prevent="save" class="w-full max-w-sm flex mt-2">
                <div class="mb-4">
                    <label for="fileInput" class="block text-gray-700 text-sm font-bold mb-2">
                        Pilih Berkas
                    </label>
                    <input
                        type="file"
                        wire:model="file"
                        id="fileInput"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    >
                </div>
    
                <div class="flex justify-between mt-3 items-center">
                    <button
                        type="submit"
                        class="bg-yellow-600 hover:bg-yellow-600 text-white font-bold py-[0.70rem] px-4 rounded focus:outline-none focus:shadow-outline"
                    >
                        Unggah
                    </button>
                </div>
            </form>
        </div>
</div>
