@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">اختيار التخصصات الجامعية</h2>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">العودة للرئيسية</a>
    </div>

    <!-- معلومات الطالب -->
    <div class="card p-4 mb-4 shadow-sm bg-light">
        <div class="row">
            <div class="col-md-4">
                <p><strong>الاسم:</strong> {{ $student->full_name }}</p>
            </div>
            <div class="col-md-4">
                <p><strong>المعدل:</strong> {{ $student->baccalaureate_score }}</p>
            </div>
            <div class="col-md-4">
                <p><strong>رقم الطالب:</strong> {{ $student->id }}</p>
            </div>
        </div>
    </div>

    <!-- فلترة البحث -->
    <div class="row mb-4">
        <div class="col-md-6">
            <input type="text" id="search" class="form-control" placeholder="ابحث عن تخصص...">
        </div>
        <div class="col-md-3">
            <select id="collegeFilter" class="form-select">
                <option value="">جميع الكليات</option>
                @foreach($colleges as $college)
                    <option value="{{ $college }}">{{ $college }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary w-100" onclick="applyFilters()">تطبيق الفلترة</button>
        </div>
    </div>

    <!-- التخصصات المتاحة -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">التخصصات المتاحة</h5>
                </div>
                <div class="card-body">
                    <div class="row" id="specializationsContainer">
                        @foreach ($specializations as $spec)
                        <div class="col-md-6 mb-3 specialization-card" 
                             data-college="{{ $spec->college }}" 
                             data-name="{{ strtolower($spec->name) }}">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $spec->name }}</h5>
                                    <p class="card-text">
                                        <i class="fas fa-university"></i> {{ $spec->college }}<br>
                                        <i class="fas fa-chair"></i> المقاعد: {{ $spec->available_seats }}<br>
                                        @if($spec->minimum_rate)
                                        <i class="fas fa-star"></i> الحد الأدنى: {{ $spec->minimum_rate }}%
                                        @endif
                                    </p>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <button class="btn btn-success w-100" 
                                    onclick="addSpecialization('{{ $spec->id }}')"
                                    {{ $student->selectedSpecializations->contains($spec->id) ? 'disabled' : '' }}>
                            
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- التخصصات المختارة -->
        <div class="col-md-4">
            <div class="card shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">قائمة اختياراتك <span class="badge bg-light text-dark" id="selectedCount">{{ count($student->selectedSpecializations) }}</span>/10</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group" id="selectedSpecializations">
                        @foreach ($student->selectedSpecializations as $selected)
                        <li class="list-group-item d-flex justify-content-between align-items-center" id="selected-{{ $selected->id }}">
                            {{ $selected->name }}
                            <button class="btn btn-sm btn-danger" onclick="removeFromSelection('{{ $selected->id }}')">
                                <i class="fas fa-times"></i>
                            </button>
                        </li>
                        @endforeach
                    </ul>
                    
                    <div class="d-grid mt-3">
                        <button class="btn btn-primary" id="submitBtn" onclick="submitSelection()" {{ count($student->selectedSpecializations) == 0 ? 'disabled' : '' }}>
                            تأكيد الاختيارات
                        </button>
                    </div>
                    
                    <div class="alert alert-info mt-3">
                        <small>
                            <i class="fas fa-info-circle"></i> يمكنك اختيار حتى 10 تخصصات.<br>
                            اسحب التخصصات لتغيير أولويتها.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
    // فلترة التخصصات
    function applyFilters() {
        const searchTerm = document.getElementById('search').value.toLowerCase();
        const collegeFilter = document.getElementById('collegeFilter').value;
        
        document.querySelectorAll('.specialization-card').forEach(card => {
            const nameMatch = card.dataset.name.includes(searchTerm);
            const collegeMatch = collegeFilter === '' || card.dataset.college === collegeFilter;
            
            card.style.display = (nameMatch && collegeMatch) ? 'block' : 'none';
        });
    }
    
    // جعل القائمة قابلة للسحب لإعادة الترتيب
    new Sortable(document.getElementById('selectedSpecializations'), {
        animation: 150,
        ghostClass: 'bg-light'
    });
    
    // إضافة تخصص
    function addSpecialization(id, name) {
        if (document.querySelectorAll('#selectedSpecializations li').length >= 10) {
            alert('لقد وصلت إلى الحد الأقصى من التخصصات المسموح بها');
            return;
        }
        
        // إضافة AJAX هنا
        fetch(`/selection/add/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                listItem.id = `selected-${id}`;
                listItem.innerHTML = `
                    ${name}
                    <button class="btn btn-sm btn-danger" onclick="removeSpecialization('${id}')">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                document.getElementById('selectedSpecializations').appendChild(listItem);
                document.querySelector(`button[onclick="addSpecialization('${id}']`).disabled = true;
                updateSelectedCount();
                document.getElementById('submitBtn').disabled = false;
            }
        });
    }
    
    // إزالة تخصص
    function removeSpecialization(id) {
        // إزالة AJAX هنا
        fetch(`/selection/remove/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById(`selected-${id}`).remove();
                document.querySelector(`button[onclick="addSpecialization('${id}']`).disabled = false;
                updateSelectedCount();
                if (document.querySelectorAll('#selectedSpecializations li').length === 0) {
                    document.getElementById('submitBtn').disabled = true;
                }
            }
        });
    }
    
    // تحديث العداد
    function updateSelectedCount() {
        const count = document.querySelectorAll('#selectedSpecializations li').length;
        document.getElementById('selectedCount').textContent = count;
    }
    
    // إرسال الاختيارات
    function submitSelection() {
        // AJAX لإرسال الترتيب النهائي
        const selectedIds = Array.from(document.querySelectorAll('#selectedSpecializations li')).map(li => li.id.replace('selected-', ''));
        
        fetch('/selection/submit', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ selections: selectedIds })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('تم حفظ اختياراتك بنجاح!');
                window.location.href = '/dashboard';
            }
        });
    }
    function addSpecialization(specId) {
    fetch('{{ route("students.specializations.add") }}', {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ 
            student_id: {{ $student->id }}, 
            specialization_id: specId 
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); // إعادة تحميل الصفحة لتحديث البيانات
        }
    });
}
function removeFromSelection(id) {
    fetch('{{ route('students.specializations.remove') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            student_id: '{{ $student->id }}',
            specialization_id: id
        })
    }).then(res => res.json()).then(() => location.reload());
}

   
        document.getElementById('search').addEventListener('input', applyFilters);
</script>

@endsection