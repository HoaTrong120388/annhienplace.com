<?php
namespace App\Helpers\Data;

use Maatwebsite\Excel\Concerns\FromArray;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



class NapTheExport implements FromArray, WithHeadings, WithColumnFormatting, WithStyles, ShouldAutoSize
{
    protected $napthe;
    private $head;
    private $columnFormats;

    public function __construct(array $napthe)
    {
        $this->napthe = $napthe;
        $this->head = [
                    'Ngày nạp',
                    'Mã đối soát',
                    'Nhà mạng',
                    'Mã thẻ',
                    'Số seri',
                    'Mệnh giá nhập',
                    'Mệnh giá thực',
                    'Chiết khấu',
                    'Thực nhận',
                    'Tình trạng',
                    'Đối tác',
                ];
        $this->columnFormats = [
            "D" => NumberFormat::FORMAT_NUMBER,
            "E" => NumberFormat::FORMAT_NUMBER,
            "F" => NumberFormat::FORMAT_NUMBER,
            "G" => NumberFormat::FORMAT_NUMBER,
            "H" => NumberFormat::FORMAT_NUMBER,
            "I" => NumberFormat::FORMAT_NUMBER
        ];
    }

    public function array(): array
    {
        return $this->napthe;
    }
    public function headings(): array
    {
        return $this->head;
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true, 'size' => 13]],
        ];
    }
    public function columnFormats(): array
    {
        return $this->columnFormats;
    }
}