<?php

namespace App\Exports;

use App\Models\Question;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class SurveyResponsesExport implements FromCollection, WithHeadings, WithColumnWidths, WithEvents
{

    private $surveyresponses;
    private $form_id;
    protected $questions;
    protected $staticColumns = ['Submitted At','Branch'];
    protected $totalColumns;

    public function __construct($surveyresponse,$form_id)
    {
        $this->surveyresponses = $surveyresponse;
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
            $row[] = $surveyresponse->branch->branch_name;

            $answersGrouped = $surveyresponse->answers->groupBy('question_id');
            // dd($answersGrouped);

            foreach ($this->questions as $question) {
                $answers = $answersGrouped->get($question->id);


                $answervalues = $answers?->map(function ($answer) {
                        return ($answer->text) ? $answer->text : optional($answer->option)->name;
                })->filter()->unique()->values();

                $row[] = $answervalues?->isNotEmpty() ? $answervalues->implode(', ') : '';
            }

            $data->push($row);
        }
        // dd($data);

        return $data;

    }


    public function headings(): array
    {
        $headings = $this->staticColumns;
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

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                foreach (range(1, 1 || count($this->surveyresponses)) as $row) {
                    $rowHeightPx = 50;
                    $rowHeight = $rowHeightPx * 0.75; // Convert pixels to Excel row height scale
                    $sheet->getRowDimension($row)->setRowHeight($rowHeight);
                }

                // Set vertical and horizontal alignment
                $getlastcolumnletter = Coordinate::stringFromColumnIndex($this->totalColumns);
                $sheet->getStyle("A1:$getlastcolumnletter" . count($this->surveyresponses)+1)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT)
                ->setVertical(Alignment::VERTICAL_CENTER);


                $sheet->getStyle("A1:${getlastcolumnletter}1")->applyFromArray([
                    'font' => [
                        'bold' => true,        // Bold text
                        'size' => 11,          // Font size
                        'color' => ['rgb' => 'FFFFFF'], // White font color
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '4F81BD'], // Blue background color
                    ],
                    // 'alignment' => [
                    //     'horizontal' => Alignment::HORIZONTAL_CENTER, // Center align text
                    //     'vertical' => Alignment::VERTICAL_CENTER, // Center vertically
                    // ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Thin border
                            'color' => ['rgb' => 'BFBFBF'], // Light gray border
                        ],
                    ],
                ]);
            },
        ];
    }
}
