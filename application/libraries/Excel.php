<?php

class Excel
{
    // Mengatur posisi teks agar ditengah secara horizontal
    public function textCenter()
    {
        //horizontal center
        $horizontalCenter = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ];
        return $horizontalCenter;

        // $sheet->getStyle('L' . $start . ':L' . $i)->applyFromArray($horizontalCenter);
    }
    public function textLeft()
    {
        //horizontal center
        $horizontalCenter = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
        ];
        return $horizontalCenter;

        // $sheet->getStyle('L' . $start . ':L' . $i)->applyFromArray($horizontalCenter);
    }
    // Mengganti warna kolom (Cell) secara dinamis
    public function cellColor($color)
    {
        $cellColor = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => $color]
            ]
        ];

        return $cellColor;
        // $sheet->getStyle('K'.$i)->applyFromArray($this->cellColor('FF4500'));
    }

    // Memberi border pada kolom
    public function border()
    {
        $border = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];
        return $border;
    }
}
