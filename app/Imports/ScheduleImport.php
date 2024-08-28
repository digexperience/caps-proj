<?php

namespace App\Imports;

use App\Models\Schedule;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Illuminate\Support\Facades\Log;

class ScheduleImport implements ToCollection, WithHeadingRow
{
    protected $sheetName;
    protected $spreadsheet;
    protected $userId;

    public function __construct($sheetName, $spreadsheet = null, $userId)
    {
        $this->sheetName = $sheetName;
        $this->spreadsheet = $spreadsheet;
        $this->userId = $userId;
    }

    public function collection(Collection $collection)
    {
        $timeSlots = [
            '7:00 - 7:30', '7:30 - 8:00', '8:00 - 8:30', '8:30 - 9:00', 
            '9:00 - 9:30', '9:30 - 10:00', '10:00 - 10:30', '10:30 - 11:00',
            '11:00 - 11:30', '11:30 - 12:00', '12:00 - 12:30', '12:30 - 13:00',
            '13:00 - 13:30', '13:30 - 13:00', '14:00 - 14:30', '14:30 - 15:00', 
            '15:00 - 15:30', '15:30 - 16:00', '16:00 - 16:30', '16:30 - 16:00',
            '16:00 - 16:30', '16:30 - 18:00', '18:00 - 18:30', '18:30 - 19:00', 
            '19:00 - 19:30', '19:30 - 20:00', '20:00 - 20:30', '20:30 - 21:00'
        ];

        if ($this->spreadsheet) {
            $sheet = $this->spreadsheet->getSheetByName($this->sheetName);
            if (!$sheet) {
                Log::error('Sheet not found', ['sheetName' => $this->sheetName]);
                return;
            }

            $data = $sheet->toArray();
            $mergedCells = $sheet->getMergeCells();
            $mergedCellValues = [];

            foreach ($mergedCells as $range) {
                list($startCell, $endCell) = explode(':', $range);
                $value = $sheet->getCell($startCell)->getValue();
                $startCoord = Coordinate::coordinateFromString($startCell);
                $endCoord = Coordinate::coordinateFromString($endCell);

                if ($value != null) {
                    $startColumn = Coordinate::columnIndexFromString($startCoord[0]);
                    $endColumn = Coordinate::columnIndexFromString($endCoord[0]);
                    $startRow = $startCoord[1];
                    $endRow = $endCoord[1];

                    for ($row = $startRow; $row <= $endRow; $row++) {
                        for ($col = $startColumn; $col <= $endColumn; $col++) {
                            $cellCoord = Coordinate::stringFromColumnIndex($col) . $row;
                            $mergedCellValues[$cellCoord] = $value;
                        }
                    }
                }
            }

            $data = array_slice($data, 1);

            foreach ($data as $rowIndex => $row) {
                $timeSlot = $timeSlots[$rowIndex] ?? null;

                foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $index => $day) {
                    $columnIndex = $index + 2;
                    $cellCoordinate = Coordinate::stringFromColumnIndex($columnIndex) . ($rowIndex + 3);

                    $section = $mergedCellValues[$cellCoordinate] ?? $row[$index + 7] ?? null;

                    if ($section != null) {
                        Log::info('Import Data', [
                            'timeSlot' => $timeSlot,
                            'day' => $day,
                            'section' => $section,
                            'room' => null,
                        ]);

                        try {
                            Schedule::updateOrCreate(
                                [
                                    'user_sched_id' => $this->userId,
                                    'time_slot' => $timeSlot,
                                    'day' => $day,
                                ],
                                [
                                    'section' => $section,
                                    'room' => null,
                                ]
                            );
                        } catch (\Exception $e) {
                            Log::error('Error saving schedule', [
                                'error' => $e->getMessage(),
                                'timeSlot' => $timeSlot,
                                'day' => $day,
                                'section' => $section,
                                'room' => null,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
