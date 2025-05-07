@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">واجهة مدير المالية</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($students->isEmpty())
        <div class="alert alert-info">لا يوجد طلاب بحاجة لتأكيد الدفع حالياً.</div>
    @else
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>الاسم</th>
                    <th>المجموع</th>
                    <th>الكلية المقبول فيها</th>
                    <th>الحالة</th>
                    <th>تأكيد الدفع</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->total_score }}</td>
                        <td>{{ $student->colleges()->wherePivot('priority', 1)->first()->name ?? 'غير محددة' }}</td>
                        <td>
                            @if($student->payment_status === 'Paid')
                                <span class="badge bg-success">مدفوع</span>
                            @else
                                <span class="badge bg-warning">لم يُدفع</span>
                            @endif
                        </td>
                        <td>
                            @if($student->payment_status !== 'Paid')
                                <form method="POST" action="{{ route('finance.confirm', $student->id) }}">
                                    @csrf
                                    <button class="btn btn-sm btn-primary">تأكيد الدفع</button>
                                </form>
                            @else
                                تم التأكيد
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
