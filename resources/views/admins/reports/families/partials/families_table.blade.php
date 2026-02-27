@if(isset($families) && $families->count() > 0)
<div>
  <a href="{{ route('admin.families.search.export',$filters) }}" class="button black x-small"><i class="fa fa-file-excel-o"></i>&nbsp; {{" تصدير إلى اكسيل" }} </a>
</div>
<br>
<table class="table responsive" id="print2">
  <thead>
    <tr>
      <th>#</th>
      <th> رقم ملف الأسرة</th>
      <th>الاسم العائلي </th>
      <th>الاسم الشخصى </th>
      <th>البطاقة الوطنية</th>
      <th>تاريخ الازدياد</th>
      <th>عدد أفراد الأسرة</th>
      <th>الاقليم</th>
      <th>المدينة / الجماعة</th>
      <th>الحساب البنكي</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($families as $family)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>
      <a target="_blank" href="{{ route('admin.families.show', $family->id) }}">
        {{ $family->id }}
      </a>
      </td>
      <td>{{ $family->mother_family_name }}</td>
      <td>{{ $family->mother_name }}</td>
      <td>{{ $family->mother_id_no }}</td>
      <td>{{ $family->mother_birth_date }}</td>
      <td>{{ $family->family_members_for_display }}</td>
      <td>{{ $family->governorate->name }}</td>
      <td>{{ $family->city->name }}</td>
      <td>{{ $family->bank_account_number }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@else
<div class="alert alert-danger text-center">
  {{ "لا توجد بيانات لعرضها. يُرجى البحث مجددًا." }}
</div>
@endif