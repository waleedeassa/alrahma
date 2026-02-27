@if(isset($cases) && $cases->count() > 0)
<div>
  {{-- <button class="button black x-small" id="print_Button" onclick="printDiv2()"> <i class="fa fa-print"></i> {{ __('dashboard.Print') }}</button> --}}
  <a href="{{ route('admin.difficult-case-families.search.export', $filters) }}" class="button black x-small"><i class="fa fa-file-excel-o"></i>&nbsp; {{" تصدير إلى اكسيل" }} </a>
</div>
<br>
<table class="table responsive" id="print2">
  <thead>
    <tr>
      <th>#</th>
      <th>رقم الحالة</th>
      <th>الاسم العائلي</th>
      <th>الاسم الشخصي</th>
      <th>البطاقة الوطنية</th>
      <th>تاريخ الازدياد</th>
      <th>عدد أفراد الأسرة</th>
      <th>فئة الحالة</th>
      <th>الوضعية الاجتماعية</th>
      <th>المستوى الدراسى </th>
      <th>الإقليم</th>
      <th>المدينة / الجماعة</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($cases as $case)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>
      <a target="_blank" href="{{ route('admin.difficult-case-families.show', $case->id) }}">
        {{ $case->id }}
      </a>
      </td>
      <td>{{ $case->last_name_ar }}</td>
      <td>{{ $case->first_name_ar }}</td>
      <td>{{ $case->national_id_no }}</td>
      <td>{{ $case->birth_date }}</td>
      <td>{{ $case->family_members_count_for_display }}</td>
      <td>{{ $case->difficult_case_type_label }}</td>
      <td>{{ $case->social_status_label }}</td>
      <td>{{ $case->education_level_label }}</td>
      <td>{{ $case->governorate->name }}</td>
      <td>{{ $case->city->name }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@else
<div class="alert alert-danger text-center">
  {{ "لا توجد بيانات لعرضها. يُرجى البحث مجددًا." }}
</div>
@endif