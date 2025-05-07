<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم الإدارة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { direction: rtl; }
        .dashboard-card { border: 1px solid #ddd; border-radius: 10px; padding: 20px; margin: 10px; }
        .stat-box { background: #f8f9fa; padding: 15px; border-radius: 8px; text-align: center; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- العنوان الرئيسي -->
        <h1 class="mb-4">لوحة تحكم الإدارة</h1>

        <!-- إحصائيات سريعة -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stat-box">
                    <h5>إجمالي الطلبات</h5>
                    <p class="fs-4">{{ $totalStudents }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-box">
                    <h5>التخصصات</h5>
                    <p class="fs-4">{{ $totalSpecializations }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-box">
                    <h5>المقاعد المتاحة</h5>
                    <p class="fs-4">{{ $totalSeats }}</p>
                </div>
            </div>
        </div>

        <!-- جدول التخصصات -->
        <div class="dashboard-card">
            <div class="d-flex justify-content-between mb-3">
                <h4>إدارة التخصصات</h4>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSpecializationModal">
                    + إضافة تخصص
                </button>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>التخصص</th>
                        <th>الكلية</th>
                        <th>الحد الأدنى</th>
                        <th>المقاعد</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($specializations as $spec)
                    <tr>
                        <td>{{ $spec->name }}</td>
                        <td>{{ $spec->college->name }}</td>
                        <td>{{ $spec->minimum_rate }}%</td>
                        <td>{{ $spec->available_seats }}</td>
                        <td>
                            <button class="btn btn-sm btn-success">تفعيل</button>
                            <button class="btn btn-sm btn-danger">حذف</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- مودال إضافة تخصص -->
        <div class="modal fade" id="addSpecializationModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>إضافة تخصص جديد</h5>
                    </div>
                    <form action="{{ route('admin.specializations.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>اسم التخصص</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>الكلية</label>
                                <select name="college_id" class="form-select">
                                    @foreach($colleges as $college)
                                        <option value="{{ $college->id }}">{{ $college->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>الحد الأدنى (%)</label>
                                <input type="number" name="minimum_rate" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>المقاعد</label>
                                <input type="number" name="seats" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>