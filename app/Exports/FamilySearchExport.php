<?php

namespace App\Exports;

use App\Services\FamiliesSearchService;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FamilySearchExport implements FromCollection, WithHeadings, WithMapping, WithEvents, WithStyles
{
  private $rowNumber = 1;
  protected array $filters;
  protected  $searchService;
  protected  $requestsCollection;
  public function __construct(array $filters, FamiliesSearchService $searchService)
  {
    $this->filters = $filters;
    $this->searchService = $searchService;
    $data = $searchService->search($this->filters);
    $this->requestsCollection = $data['families'];
  }
  public function collection()
  {
    return $this->requestsCollection;
  }
  public function headings(): array
  {
    return [
      '#',
      'رقم العائلة',
      'اسم ولي أمر اليتيم',
      'صلته باليتيم',
      'رقم الهاتف 1',
      'رقم الهاتف 2',
      'العنوان الكامل',
      'الإقليم',
      'المدينة / الجماعة',
      'مهنة الأب المتوفى',
      'سبب وفاة الأب',
      'تاريخ وفاة الأب',
      'هل الأم متوفيه',
      'تاريخ وفاة الأم',
      'سبب وفاة الأم',
      'اسم الأم بالعربية',
      'نسب الأم بالعربيه',
      'اسم الأم بالفرنسية',
      'نسب الأم بالفرنسية',
      'رقم البطاقة الوطنيه للأم',
      'تاريخ انتهاء صلاحية البطاقة الوطنية',
      'تاريخ ازدياد الأم',
      'الحساب البنكى',
      'التغطيه الصحيه',
      'الحالة الصحية للأم',
      'عدد افراد الاسرة',
      'المستوى الدراسي',
      'المؤهلات المهنية و الحرفية',
      'هل تعمل الأم ؟',
      'نوع العمل',
      'هل تستفيد من دعم الأرامل ؟',
      'مبلغ الدعم للأم',
      'هل تستفيد الأسرة من تعويض تقاعد الزوج؟',
      'المبلغ الشهري من تعويض تقاعد الزوج',
      'هل للأرملة مصدر آخر للدخل ؟',
      'مصدر الدخل الاخر',
      'المبلغ الشهري للدخل الأخر',
      'هل الدخل قار ؟',
      'صفة حيازة المسكن',
      'نوع المسكن',
      'حالة المسكن',
      'مجال المسكن',
      'هل العائلة تتوفر على معيل؟',
      'اسم المعيل بالعربي',
      'اسم المعيل بالفرنسية',
      'نسب المعيل بالعربيه',
      'نسب المعيل بالفرنسية',
      'مهنة المعيل',
      'رقم البطاقة الوطنية للمعيل',
      'رقم هاتف المعيل',
    ];
  }
  public function map($family): array
  {
    return [
      $this->rowNumber++,
      $family->id,
      $family->orphan_guardian_name,
      $family->relationship_to_the_orphan_label ?? '',
      $family->phone1,
      $family->phone2,
      $family->address,
      $family->governorate->name ?? '',
      $family->city->name ?? '',
      $family->father_job,
      $family->father_death_reason_label ?? '',
      $family->father_death_date,
      $family->mother_alive_label ?? '',
      $family->mother_death_date,
      $family->mother_death_reason_label ?? '',
      $family->mother_name,
      $family->mother_family_name,
      $family->mother_name_in_french,
      $family->mother_family_name_in_french,
      $family->mother_id_no,
      $family->mother_id_expire_date,
      $family->mother_birth_date,
      $family->bank_account_number,
      $family->medical_insurance_label ?? '',
      $family->mother_health_status_label ?? '',
      $family->family_members_for_display,
      $family->mother_education_level_label ?? '',
      $family->mother_qualifications_label ?? '',
      $family->does_mother_work_label ?? '',
      $family->mother_working_type_label ?? '',
      $family->mother_widows_support_label ?? '',
      $family->mother_widows_support_amount,
      $family->has_retirement_compensation_label ?? '',
      $family->husband_retirement_compensation_amount,
      $family->is_there_another_source_of_income_label ?? '',
      $family->mother_other_income_type_label ?? '',
      $family->mother_other_income_amount,
      $family->is_mother_other_income_fixed_label ?? '',
      $family->housing_ownership_label ?? '',
      $family->housing_type_label ?? '',
      $family->housing_status_label ?? '',
      $family->housing_area_label ?? '',
      $family->has_breadwinner_label ?? '',
      $family->breadwinner_name,
      $family->breadwinner_french_name,
      $family->breadwinner_family_name,
      $family->breadwinner_family_in_french,
      $family->breadwinner_job,
      $family->breadwinner_id_no,
      $family->breadwinner_phone,
    ];
  }

  public function styles(Worksheet $sheet)
  {
    $sheet->setRightToLeft(true);
    $sheet->getStyle('A1:AX1')->applyFromArray([
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
