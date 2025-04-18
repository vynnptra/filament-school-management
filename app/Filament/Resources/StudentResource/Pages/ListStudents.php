<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use App\Imports\ImportStudent;
use App\Models\Student;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ListStudents extends ListRecords
{
    use WithFileUploads;
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getHeader(): ?View
    {
        $data = Actions\CreateAction::make();
        return view('filament.students.customs.header', compact('data') );
    }

    public $file;

    public function save()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,csv,txt',
        ]);
    
        Excel::import(new ImportStudent, $this->file);
    
        session()->flash('message', 'Impor berhasil!');
    }
}
