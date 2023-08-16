<div>
    <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
        <!-- Profile Photo File Input -->
        <input type="file" class="hidden"
            wire:model="photo"
            x-ref="photo"
            x-on:change="
                photoName = $refs.photo.files[0].name;
                const reader = new FileReader();
                reader.onload = (e) => {
                    photoPreview = e.target.result;
                };
                reader.readAsDataURL($refs.photo.files[0]);
            " />
    
        <x-jet-label for="photo" value="{{ __('Photo') }}" />
    
        <!-- Current Profile Photo -->
        <div class="mt-2" x-show="! photoPreview">
            </div>
    
        <!-- New Profile Photo Preview -->
        <div class="mt-2" x-show="photoPreview" style="display: none;">
            <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
            </span>
        </div>
    
        <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
            {{ __('Select A New Photo') }}
        </x-jet-secondary-button>
    
       
    
        <x-jet-input-error for="photo" class="mt-2" />
    </div>
    
</div>
