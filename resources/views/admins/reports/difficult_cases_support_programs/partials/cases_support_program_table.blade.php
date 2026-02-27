@if(isset($results) && $results->count() > 0)
<div>
  <a href="{{ route('admin.difficult-case-support-programs.search.export', $filters ?? []) }}" class="button black x-small">
    <i class="fa fa-file-excel-o"></i>&nbsp; {{ "تصدير إلى اكسيل" }}
  </a>
</div>
<br>

<div class="table-responsive">
  <table class="table table-bordered table-hover text-center" id="print2">
    <thead class="bg-light">
      <tr>
        <th>#</th>
        <th>اسم البرنامج</th>
        <th>تاريخ الاستفادة</th>
        <th>الاسم العائلي (ع)</th>
        <th>الاسم الشخصي (ع)</th>
        <th>رقم البطاقة الوطنية</th>
        <th>عدد أفراد الأسرة</th>
        <th>فئة الحالة</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($results as $item)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td >{{ $item->program->name ?? 'غير محدد' }}</td>
        <td>{{ $item->date }}</td>
        <td>{{ $item->family->last_name_ar ?? '-' }}</td>
        <td>
          @if(Route::has('admin.difficult-case-families.show'))
          <a target="_blank" href="{{ route('admin.difficult-case-families.show', $item->family->id) }}">
            {{ $item->family->first_name_ar ?? '-' }}
          </a>
          @else
          {{ $item->family->first_name_ar ?? '-' }}
          @endif
        </td>
        <td>{{ $item->family->national_id_no ?? '-' }}</td>
        <td>{{ $item->family->family_members_count_for_display ?? 0 }}</td>
        <td>{{ $item->family->difficult_case_type_label }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@else
<div class="alert alert-danger text-center" role="alert">
  <i class="fa fa-info-circle"></i> {{ "لا توجد نتائج مطابقة لعملية البحث." }}
</div>
@endif