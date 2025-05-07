@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <h2 class="text-center mb-4">طلبات الطلاب المسجلين</h2>

        <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden shadow-md">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">الاسم</th>
                    <th class="px-4 py-2 border">الهوية</th>
                    <th class="px-4 py-2 border">البريد الإلكتروني</th>
                    <th class="px-4 py-2 border">رقم الهاتف</th>
                    <th class="px-4 py-2 border">المجموع</th>
                    <th class="px-4 py-2 border">الشهادة</th>
                    <th class="px-4 py-2 border">اختبار العمارة</th>
                    <th class="px-4 py-2 border">الكليات المُختارة</th>
                    <th class="px-4 py-2 border">حالة الطلب</th>
                    <th class="px-4 py-2 border">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($students as $student)
                    <tr class="border-b">
                        <td class="px-4 py-2 border">{{ $student->id }}</td>
                        <td class="px-4 py-2 border">{{ $student->name }}</td>
                        <td class="px-4 py-2 border">{{ $student->national_id }}</td>
                        <td class="px-4 py-2 border">{{ $student->email }}</td>
                        <td class="px-4 py-2 border">{{ $student->phone }}</td>
                        <td class="px-4 py-2 border">{{ $student->total_score }}</td>
                        <td class="px-4 py-2 border"><a href="{{ asset('storage/' . $student->certificate_image) }}" target="_blank" class="text-blue-500 hover:underline">عرض الشهادة</a></td>
                        <td class="px-4 py-2 border">{{ $student->architecture_exam }}</td>
                        <td class="px-4 py-2 border">
                            <ul class="list-unstyled">
                                @foreach ($student->colleges as $college)
                                    <li>{{ $college->name }}{{$college->id}}</li>
                                @endforeach
                            </ul>
                            
                        </td>
                        <td class="px-4 py-2 border">
                            @if ($student->status === 'Accepted')
                                <span class="px-2 py-1 text-green-700 bg-green-200 rounded">مقبول</span>
                            @elseif ($student->status === 'Rejected')
                                <span class="px-2 py-1 text-red-700 bg-red-200 rounded">مرفوض</span>
                            @else
                                <span class="px-2 py-1 text-gray-700 bg-gray-200 rounded">قيد المراجعة</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border flex gap-2">
                            @if ($student->status !== 'Accepted')
                                <form action="{{ route('Students.accept', $student->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 text-white bg-green-500 rounded hover:bg-green-600">قبول</button>
                                </form>
                                <form action="{{ route('Students.reject', $student->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600">رفض</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- التصفح (Pagination) -->
        <div class="mt-4 flex justify-center">
            {{ $students->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
