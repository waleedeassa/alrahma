<?php

namespace App\Exports;

use App\Services\SpecialNeedsPersonSupportProgramSearchService;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SpecialNeedsPersonSupportProgramsSearchExport implements FromCollection, WithHeadings, WithMapping, WithEvents, WithStyles
{
  private $rowNumber = 1;
  protected array $filters;
  protected $searchService;
  protected $requestsCollection;

  public function __construct(array $filters, SpecialNeedsPersonSupportProgramSearchService $searchService)
  {
    $this->filters = $filters;
    $this->searchService = $searchService;
    $data = $searchService->search($this->filters);
    $this->requestsCollection = $data['results'];
  }
  public function collection()
  {
    return $this->requestsCollection;
  }
  public function headings(): array
  {
    return [
      '#',
      'اسم البرنامج',
      'تاريخ الاستفادة',
      'الاسم العائلي (ع)',
      'الاسم الشخصي (ع)',
      'رقم البطاقة الوطنية',
      'عدد أفراد الأسرة',
      'نوع الإعاقة / الحالة',
    ];
  }
  public function map($result): array
  {
    return [
      $this->rowNumber++,
      $result->program->name,
      $result->date,
      $result->person->last_name_ar,
      $result->person->first_name_ar,
      $result->person->national_id_no,
      $result->person->family_members_count_for_display,
      $result->person->special_needs_type_label,
    ];
  }
  public function styles(Worksheet $sheet)
  {
    $sheet->setRightToLeft(true);
    $sheet->getStyle('A1:H1')->applyFromArray([
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
