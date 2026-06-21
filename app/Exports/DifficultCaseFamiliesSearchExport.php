<?php

namespace App\Exports;

use App\Models\DifficultCaseFamily;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Services\DifficultCaseFamiliesSearchService;

class DifficultCaseFamiliesSearchExport implements FromCollection, WithHeadings, WithMapping, WithEvents, WithStyles
{
  private $rowNumber = 1;
  protected array $filters;
  protected  $searchService;
  protected  $requestsCollection;
  public function __construct(array $filters, DifficultCaseFamiliesSearchService $searchService)
  {
    $this->filters = $filters;
    $this->searchService = $searchService;
    $data = $searchService->search($this->filters);
    $this->requestsCollection = $data['cases'];
  }
  public function collection()
  {
    return $this->requestsCollection;
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
      'هل استفادت سابقاً؟',
      'نوع الخدمة المطلوبة',
      'منطقة السكن',
      'النشاط المهني',
      'جنس المتعدي',
      'علاقة المتعدي بالضحية',
      'المستوى الدراسي للمتعدي',
      'الحالة العائلية للمتعدي',
      'صلة القرابة',
      'نوع العنف',
      'مكان العنف',
      'توقيت العنف',
      'وتيرة العنف',
      'التدخلات المنجزة خارج المؤسسة',
    ];
  }
  public function map($case): array
  {
    return [
      $this->rowNumber++,
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
      $case->previously_benefited_label ?? '',
      $case->required_service_label ?? '',
      $case->housing_area_label ?? '',
      $case->beneficiary_activity_label ?? '',
      $case->aggressor_gender_label ?? '',
      $case->aggressor_relationship_label ?? '',
      $case->aggressor_education_level_label ?? '',
      $case->aggressor_family_status_label ?? '',
      $case->aggressor_kinship_label ?? '',
      $case->violence_type_label ?? '',
      $case->violence_place_label ?? '',
      $case->violence_time_label ?? '',
      $case->violence_frequency_label ?? '',
      $case->external_interventions_label ?? '',
    ];
  }
  public function styles(Worksheet $sheet)
  {
    $sheet->setRightToLeft(true);
    $sheet->getStyle('A1:AF1')->applyFromArray([
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
