<?php

namespace App\Http\Livewire;

use App\Models\Employee as ModelsEmployee;  // Renamed Karyawan to Employee
use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rules\Password;
use Livewire\WithPagination;

class Employees extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $add, $edit, $delete, $search;
    public $name, $email, $password, $password_confirmation, $address, $phone, $employee_id;

    protected function rules()
    {
        $employee = ModelsEmployee::find($this->employee_id);

        $rule = [
            'name' => 'required',
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'password' => ['required', Password::min(8), 'confirmed'],
            'phone' => ['required', 'numeric', 'digits:12'],
            'address' => ['required'],
        ];

        if ($this->edit) {
            if (!$this->password && !$this->password_confirmation) {
                $rule['password'] = '';
            }
            if ($this->email == $employee->user->email) {
                $rule['email'] = '';
            }
        }

        return $rule;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function show_add()
    {
        $this->add = true;
    }

    public function store()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name, 
            'email' => $this->email, 
            'password' => bcrypt($this->password),
            'role_id' => 2
        ]);

        ModelsEmployee::create([
            'user_id' => $user->id,
            'phone' => $this->phone,
            'address' => $this->address
        ]);

        session()->flash('success', 'Data successfully added.');
        $this->format();
    }

    public function show_edit(ModelsEmployee $employee)
    {
        $this->edit = true;

        $this->employee_id = $employee->id;
        $this->name = $employee->user->name;
        $this->email = $employee->user->email;
        $this->address = $employee->address;
        $this->phone = $employee->phone;
    }

    public function update()
    {
        $this->validate();

        $employee = ModelsEmployee::find($this->employee_id);

        $data_user = [
            'name' => $this->name, 
            'email' => $this->email, 
            'password' => bcrypt($this->password),
        ];

        if (!$this->password) {
            unset($data_user['password']);
        }

        $employee->user->update($data_user);

        $employee->update([
            'phone' => $this->phone,
            'address' => $this->address
        ]);

        session()->flash('success', 'Data successfully updated.');
        $this->format();
    }

    public function show_delete(ModelsEmployee $employee)
    {
        $this->delete = true;

        $this->employee_id = $employee->id;
        $this->name = $employee->user->name;
    }

    public function destroy()
    {
        $employee = ModelsEmployee::find($this->employee_id);

        User::whereId($employee->user_id)->delete();
        $employee->delete();

        session()->flash('success', 'Data successfully deleted.');
        $this->updatingSearch();
        $this->format();
    }

    public function format()
    {
        unset($this->name, $this->email, $this->password, $this->password_confirmation, $this->phone, $this->address, $this->employee_id);
        $this->add = false;
        $this->edit = false;
        $this->delete = false;
    }

    public function format_search()
    {
        $this->search = '';
    }

    public function render()
    {
        if ($this->search) {
            $employees = ModelsEmployee::whereHas('user', function($user){
                $user->where('name', 'like', '%'. $this->search .'%');
            })->paginate(5);
        } else {
            $employee = ModelsEmployee::paginate(5);
        }
        return view('livewire.Employees', compact('employee'));
    }
}
