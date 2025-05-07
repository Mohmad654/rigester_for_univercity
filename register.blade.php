@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">تسجيل المفاضلة الجامعية</h2>
    <form id="collegeForm" action="{{ route('students.store') }}" method="POST" class="p-4 shadow-sm bg-white rounded" enctype="multipart/form-data">
        @csrf

        <!-- الاسم الكامل واسم الأم -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="full_name" class="form-label fw-bold">الاسم الكامل</label>
                <input type="text" id="full_name" name="full_name" class="form-control" placeholder="أدخل اسمك الكامل" required>
            </div>
            <div class="col-md-6">
                <label for="mother_name" class="form-label fw-bold">اسم الأم</label>
                <input type="text" id="mother_name" name="mother_name" class="form-control" placeholder="أدخل اسم الأم" required>
            </div>
        </div>

        <!-- الكنية والرقم الوطني -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="family_name" class="form-label fw-bold">الكنية</label>
                <input type="text" id="family_name" name="family_name" class="form-control" placeholder="أدخل الكنية" required>
            </div>
            <div class="col-md-6">
                <label for="national_id" class="form-label fw-bold">الرقم الوطني</label>
                <input type="text" id="national_id" name="national_id" class="form-control" placeholder="أدخل الرقم الوطني" required>
            </div>
        </div>

        <!-- رقم الهاتف -->
        <div class="mb-3">
            <label for="phone" class="form-label fw-bold">رقم الهاتف</label>
            <input type="text" id="phone" name="phone" class="form-control" placeholder="أدخل رقم الهاتف" required>
        </div>

        <!-- درجة البكالوريا -->
        <div class="mb-3">
            <label for="baccalaureate_score" class="form-label fw-bold">درجة البكالوريا</label>
            <input type="number" step="0.01" id="baccalaureate_score" name="baccalaureate_score" class="form-control" placeholder="أدخل درجة البكالوريا" required>
        </div>

  

        <!-- صورة الشهادة -->
        <div class="mb-3">
            <label for="certificate_image" class="form-label fw-bold">صورة الشهادة</label>
            <input type="file" id="certificate_image" name="certificate_image" class="form-control" required>
        </div>
      
        <!-- زر الإرسال -->
        <button type="submit" class="btn btn-primary w-100">تسجيل البيانات</button>
    </form>
</div>

<!-- سكربت -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function updatePreferencesOrder(element) {
        const preferences = document.querySelectorAll('#preferences input[type="checkbox"]:checked');
        preferences.forEach((checkbox, index) => {
            checkbox.nextElementSibling.textContent = `${index + 1}. ${checkbox.nextElementSibling.textContent.split('. ')[1] || checkbox.nextElementSibling.textContent}`;
        });
    }
</script>

<!-- سكربت -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function validateTotalScore() {
        let totalScoreInput = document.getElementById('total_score');
        let warningMessage = document.getElementById('score_warning');

        if (totalScoreInput.value > 240) {
            warningMessage.style.display = 'block';
            totalScoreInput.value = 240;
        } else {
            warningMessage.style.display = 'none';
        }
    }
    function checkArchitectureExam(element) {
        const architectureExamDiv = document.getElementById('architecture_exam_question');

        if (element.checked && element.value === 'architecture') {
            architectureExamDiv.style.display = 'block';
        } else {
            architectureExamDiv.style.display = 'none';
        }
    }

</script>
@endsection