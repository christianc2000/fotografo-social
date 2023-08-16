<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadProfilePhoto extends Component
{
    use WithFileUploads;

    public $photo;

    public function render()
    {
        return view('livewire.upload-profile-photo');
    }

    public function uploadPhoto()
    {
        // Validar y procesar la foto
        if ($this->photo) {
            $path = $this->photo->store('profile-photos', 'public'); // Guarda la foto en la carpeta "profile-photos" del almacenamiento público
            // Realizar cualquier otro procesamiento necesario aquí
            // Por ejemplo, actualizar la URL de la foto en la base de datos
            // $user->profile_photo_url = asset('storage/' . $path);
            // $user->save();

            $this->dispatchBrowserEvent('uploaded'); // Mostrar un mensaje de éxito
            $this->reset('photo'); // Limpiar el campo de archivo
        }
    }
   
}
