<?php

namespace App\Filament\Resources\StudentHasClassResource\Pages;

use App\Filament\Resources\StudentHasClassResource;
use App\Models\HomeRoom;
use App\Models\Periode;
use App\Models\Student;
use App\Models\StudentHasClass;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\Page;

class FormStudentHasClass extends Page implements HasForms
{
    use InteractsWithForms;
    protected static string $resource = StudentHasClassResource::class;

    protected static string $view = 'filament.resources.student-has-class-resource.pages.form-student-has-class';

    public $students = [];
    public $homerooms = '';
    public $periode = '';
    

    public function mount(){
        $this->form->fill(); 
    }

    public function getFormSchema(): array{
        return [
            Card::make()
            ->schema([
                Select::make('students')
                ->label('Students')
                ->multiple()
                ->columnSpan(3)
                ->options(Student::all()->pluck('name', 'id')),
                Select::make('homerooms')
                ->label('Homerooms')
                ->options(HomeRoom::with('classrooms')->whereNotNull('classrooms_id')->get()->mapWithKeys(fn ($homeroom) => [$homeroom->id => $homeroom->classrooms->name])),
                Select::make('periode')
                ->label('Periode')
                ->options(Periode::query()->whereNotNull('name')->pluck('name', 'id')),
            ])
            ->columns(3)
        ]; 
    }

    public function save() {
        $students = $this->students;
        $insert = [];
        foreach ($students as $key => $row) {
            array_push($insert, [
                'students_id' => $row,
                'homerooms_id' => $this->homerooms,
                'periode_id' => $this->periode,
                'is_open' => 1,
            ]);
        }
        StudentHasClass::insert($insert);

        return redirect()->to('admin/student-has-classes');
    }
}
