<?php

namespace App\Exports;

use App\Models\DifficultCaseFamily;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class DifficultCaseFamiliesExport implements FromQuery, WithChunkReading, WithHeadings, WithMapping, WithEvents, WithStyles
{
  private $rowNumber = 0;
  public function query()
  {
    return DifficultCaseFamily::query()
      ->with([
        'governorate:id,name',
        'city:id,name',
      ])
      ->latest('id');
  }
  public function chunkSize(): int
  {
    return 1000;
  }
  public function headings(): array
  {
    return [
      '#',
      'رقم الحالة',
      'تاريخ التسجيل',
      'الاسم الشخصي بالعربية',
      'الاسم العائلي بالعربية',
      'الاسم الشخصي بالفرنسية',
      'الاسم العائلي بالفرنسية',
      'رقم البطاقة الوطنية',
      'النوع',
      'تاريخ الازدياد',
      'المستوى الدراسي',
      'عدد أفراد الأسرة',
      'فئة الحالة',
      'الوضعية الاجتماعية',
      'الإقليم',
      'المدينة / الجماعة',
      'العنوان الكامل',
      'رقم الهاتف',
    ];
  }
  public function map($case): array
  {
    $this->rowNumber++;
    return [
      $this->rowNumber,
      $case->id,
      $case->registration_date,
      $case->first_name_ar,
      $case->last_name_ar,
      $case->first_name_fr,
      $case->last_name_fr,
      $case->national_id_no,
      $case->gender_label ?? '',
      $case->birth_date,
      $case->education_level_label ?? '',
      $case->family_members_count_for_display,
      $case->difficult_case_type_label ?? '',
      $case->social_status_label ?? '',
      $case->governorate->name ?? '',
      $case->city->name ?? '',
      $case->address,
      $case->phone,
    ];
  }
  public function styles(Worksheet $sheet)
  {
    $sheet->freezePane('A2');
    $sheet->setAutoFilter('A1:R1');
    $sheet->setRightToLeft(true);
    $sheet->getStyle('A1:R1')->applyFromArray([
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
