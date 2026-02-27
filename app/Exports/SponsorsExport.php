<?php

namespace App\Exports;

use App\Models\Sponsor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;

class SponsorsExport implements FromCollection, WithHeadings, WithMapping, WithEvents, WithStyles
{
  private $rowNumber = 1;
  public function collection()
  {
    return Sponsor::select('id', 'name', 'type', 'email', 'phone', 'created_at')->get();
  }

  public function headings(): array
  {
    return [
      '#',
      'الاسم',
      'النوع',
      'البريد الالكترونى',
      'رقم الهاتف',
      'تاريخ الإضافة',
      // 'عدد الأيتام المكفولين',
    ];
  }

  public function map($sponsor): array
  {
    return [
      $this->rowNumber++,
      $sponsor->name,
      $sponsor->type_label,
      $sponsor->email,
      $sponsor->phone,
      $sponsor->created_at ? $sponsor->created_at->format('Y-m-d') : '',
      // $report->orphans->count(), // Count of related orphans
    ];
  }

  public function styles(Worksheet $sheet)
  {
    $sheet->setRightToLeft(true);
    $sheet->getStyle('A1:F1')->applyFromArray([
      'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF'],
      ],
      'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '296060'],
      ],
      'alignment' => [
        'horizontal' => 'center',
        'vertical' => 'center',
      ],
    ]);
  }
  public function registerEvents(): array
  {
    return [
      \Maatwebsite\Excel\Events\AfterSheet::class => function (\Maatwebsite\Excel\Events\AfterSheet $event) {
        $event->sheet->getDelegate()->setRightToLeft(true);
      },
    ];
  }
}
