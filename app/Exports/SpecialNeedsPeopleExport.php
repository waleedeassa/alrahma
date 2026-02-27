<?php

namespace App\Exports;

use App\Models\SpecialNeedsPerson;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class SpecialNeedsPeopleExport implements FromQuery, WithChunkReading, WithHeadings, WithMapping, WithEvents, WithStyles
{
  private $rowNumber = 0;
  public function query()
  {
    return SpecialNeedsPerson::query()
      ->with([
        'governorate:id,name',
        'city:id,name',
      ])
      ->latest('id');
  }
  public function chunkSize(): int
  {
    return 500;
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
      'نوع الاحتياج الخاص',
      'الوضعية الاجتماعية',
      'الإقليم',
      'المدينة / الجماعة',
      'العنوان الكامل',
      'رقم الهاتف',
    ];
  }

  public function map($person): array
  {
    $this->rowNumber++;
    return [
      $this->rowNumber,
      $person->id,
      $person->registration_date,
      $person->first_name_ar,
      $person->last_name_ar,
      $person->first_name_fr,
      $person->last_name_fr,
      $person->national_id_no,
      $person->gender_label ?? '',
      $person->birth_date,
      $person->education_level_label ?? '',
      $person->family_members_count_for_display,
      $person->special_needs_type_label ?? '',
      $person->social_status_label ?? '',
      $person->governorate->name ?? '',
      $person->city->name ?? '',
      $person->address,
      $person->phone,
    ];
  }

  public function styles(Worksheet $sheet)
  {
    $sheet->freezePane('A2');
    $sheet->setAutoFilter('A1:R1');
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
      AfterSheet::class => function (AfterSheet $event) {
        $event->sheet->getDelegate()->setRightToLeft(true);
      },
    ];
  }
}
