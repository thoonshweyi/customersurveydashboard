<?php

namespace App\Exports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class SurveyResponsesExport implements FromCollection, WithHeadings, WithColumnWidths
{

    private $surveyresponses;
    private $form_id;
    protected $questions;
    protected $staticColumns = ['Submitted At'];
    protected $totalColumns;

    public function __construct($surveyresponse,$form_id)
    {
        $this->surveyresponse = $surveyresponse;
        $this->form_id = $form_id;
        $this->questions = Question::where('form_id', $form_id)->get();

        $totalStatic = count($this->staticColumns);
        $this->totalColumns = $totalStatic + count($this->questions);
    }

    public function collection()
    {
        $data = collect();

         foreach ($this->surveyresponses as $surveyresponse) {
            $row = [];
            $row[] = $surveyresponse->submitted_at;

            $answersMap =  $surveyresponse->answers->pluck('text', 'question_id');

            foreach ($this->questions as $question) {
                $row[] = $answersMap[$question->id] ?? '';
            }

            $data[] = $row;
        }

        return $data;

    }


    public function headings(): array
    {
        $headings = ['Submitted At'];
        foreach ($this->questions as $question) {
            $headings[] = $question->name;
        }
        return $headings;
    }

    public function columnWidths(): array
    {
        $columnWidthPx = 250;
        $columnWidth = $columnWidthPx / 7;

        for ($i = 1; $i <= $this->totalColumns; $i++) {
            $columnLetter = Coordinate::stringFromColumnIndex($i);
            $columnWidths[$columnLetter] = $columnWidth;
        }

        return $columnWidths;
    }
}
