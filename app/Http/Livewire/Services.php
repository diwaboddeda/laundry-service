<?php

namespace App\Http\Livewire;

use App\Models\Service as ModelsService;  // Change to 'Service'
use Livewire\Component;
use Livewire\WithPagination;

class Services extends Component // Change class name to 'Service'
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $add, $edit, $delete, $search; // Change 'tambah', 'hapus' to 'add', 'delete'
    public $name, $duration, $price, $service_id; // Change 'nama', 'durasi', 'harga', 'layanan_id' to English

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'duration' => 'required|min:1|numeric', // Change 'durasi' to 'duration'
            'price' => 'required|min:30|numeric', // Change 'harga' to 'price'
        ];
    }

    public function showAddForm()
    {
        $this->add = true;
    }

    public function store()
    {
        $this->validate();

        ModelsService::create([  // Change 'Layanan' to 'Service'
            'name' => $this->name,
            'duration' => $this->duration, // Change 'durasi' to 'duration'
            'price' => $this->price, // Change 'harga' to 'price'
        ]);

        session()->flash('success', 'Data has been saved successfully.'); // Change success message
        $this->resetForm();
    }

    public function showEditForm(ModelsService $service) // Change 'layanan' to 'service'
    {
        $this->edit = true;
        $this->service_id = $service->id;
        $this->price = $service->price; // Change 'harga' to 'price'
        $this->name = $service->name; // Change 'nama' to 'name'
        $this->duration = $service->duration; // Change 'durasi' to 'duration'
    }

    public function update()
    {
        $this->validate();

        $service = ModelsService::whereId($this->service_id)->update([ // Change 'Layanan' to 'Service'
            'name' => $this->name,
            'duration' => $this->duration, // Change 'durasi' to 'duration'
            'price' => $this->price, // Change 'harga' to 'price'
        ]);

        session()->flash('success', 'Data has been updated successfully.'); // Change success message
        $this->resetForm();
    }

    public function showDeleteForm(ModelsService $service) // Change 'layanan' to 'service'
    {
        $this->delete = true;
        $this->service_id = $service->id;
        $this->name = $service->name; // Change 'nama' to 'name'
    }

    public function destroy()
    {
        ModelsService::whereId($this->service_id)->delete(); // Change 'Layanan' to 'Service'

        session()->flash('success', 'Data has been deleted successfully.'); // Change success message
        $this->updatingSearch();
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->add = false;
        $this->edit = false;
        $this->delete = false;
        unset($this->name, $this->duration, $this->price, $this->service_id); // Change 'nama' to 'name', 'durasi' to 'duration', 'harga' to 'price'
    }

    public function resetSearch()
    {
        $this->search = '';
    }

    public function render()
    {
        if ($this->search) {
            $services = ModelsService::where('name', 'like', '%'. $this->search .'%')->paginate(5); // Change 'layanan' to 'service', 'nama' to 'name'
        } else {
            $services = ModelsService::paginate(5); // Change 'layanan' to 'service'
        }
        return view('livewire.Services', compact('services')); // Change 'layanan' to 'service'
    }
}
