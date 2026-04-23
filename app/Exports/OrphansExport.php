<?php

namespace App\Exports;

use App\Models\Orphan;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrphansExport implements FromQuery, WithChunkReading, WithHeadings, WithMapping, WithEvents, WithStyles
{
  use Exportable;
  private $rowNumber = 0;
  protected $filters;

  public function __construct($filters)
  {
    $this->filters = $filters;
  }
  public function query()
  {
    return Orphan::query()
      ->with([
        'governorate:id,name',
        'city:id,name',
        'sponsor:id,name',
        'supervisor:id,name',
        'family:id,mother_name,mother_family_name,phone1',
      ])
      // sponsorship status filter
      ->when(isset($this->filters['sponsorship_status']) && $this->filters['sponsorship_status'] !== '', function ($q) {
        $q->where('sponsorship_status', $this->filters['sponsorship_status']);
      })
      // academic level filter
      ->when(!empty($this->filters['academic_level']), function ($q) {
        $q->where('academic_level', $this->filters['academic_level']);
      })
      // sponsor filter
      ->when(!empty($this->filters['sponsor_id']), function ($q) {
        $q->where('sponsor_id', $this->filters['sponsor_id']);
      })
      // governorate filter
      ->when(!empty($this->filters['governorate_id']), function ($q) {
        $q->where('governorate_id', $this->filters['governorate_id']);
      })
      // gender filter
      ->when(!empty($this->filters['gender']), function ($q) {
        $q->where('gender', $this->filters['gender']);
      })
      // specialization filter
      ->when(!empty($this->filters['specialization']), function ($q) {
        $q->where('specialization', $this->filters['specialization']);
      })
      // has land filter
      ->when(isset($this->filters['has_land']) && $this->filters['has_land'] !== '', function ($q) {
        $q->where('does_family_own_a_plot_of_land', $this->filters['has_land']);
      })
      // social status filter
      ->when(!empty($this->filters['social_status']), function ($q) {
        $q->where('social_status', $this->filters['social_status']);
      })
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
      'رقم اليتيم',
      'كود الكفالة',
      'حالة الكفالة',
      'الاسم الشخصي (عربي)',
      'الاسم الشخصي (فرنسي)',
      'اسم العائلة (عربي)',
      'اسم العائلة (فرنسي)',
      'اسم الأم',
      'رقم الهاتف',
      'تاريخ الازدياد',
      'العمر',
      'الجنس',
      'الإقليم',
      'المدينة',
      'اسم المدينة بالفرنسية',
      'العنوان بالعربية',
      'العنوان بالفرنسية',
      'التخصص',
      'هل تمتلك الأسرة قطعة أرض',
      'الوضعية الاجتماعية',
      'رقم الهاتف',
      'الفصيلة الدموية',
      'الحالة الصحية',
      'المستوى الدراسي',
      'قياس الحذاء',
      'قياس الملابس',
      'الكفيل',
      'المشرف',
      'تاريخ الإضافة',
    ];
  }

  public function map($orphan): array
  {
    $this->rowNumber++;
    return [
      $this->rowNumber,
      $orphan->id,
      $orphan->orphan_sponsorship_code ?? 'لا يوجد',
      $orphan->sponsorship_status_label,
      $orphan->name_ar,
      $orphan->name_fr,
      $orphan->family_name_ar,
      $orphan->family_name_fr,
      $orphan->family->mother_name . ' ' . $orphan->family->mother_family_name,
      $orphan->phone,
      $orphan->birth_date,
      $orphan->age_label,
      $orphan->gender_label,
      $orphan->governorate->name ?? '',
      $orphan->city->name ?? '',
      $orphan->city_in_french,
      $orphan->address,
      $orphan->address_in_french,
      $orphan->specialization_label,
      $orphan->does_family_own_a_plot_of_land_label,
      $orphan->social_status_label ?? '',
      $orphan->phone,
      $orphan->blood_type_label,
      $orphan->health_status_label,
      $orphan->academic_level_label,
      $orphan->shoe_size,
      $orphan->clothes_size,
      $orphan->sponsor->name ?? 'بدون كفيل',
      $orphan->supervisor->name ?? '',
      optional($orphan->created_at)->format('Y-m-d'),
    ];
  }


  public function styles(Worksheet $sheet)
  {
    $sheet->freezePane('A2');
    $sheet->setAutoFilter('A1:AD1');
    $sheet->getStyle('A1:AD1')->applyFromArray([
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
