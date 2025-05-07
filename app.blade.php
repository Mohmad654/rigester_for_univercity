<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام المفاضلة الجامعية</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>  
.navbar {
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
  }
  
  </style>
<body>
    
    <!-- الشريط العلوي -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
          <a class="navbar-brand fw-bold" href="#">نظام القبول والمفاضلة</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">الرئيسية</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('students.create') }}">تسجيل طالب</a></li>
              <li class="nav-item"><a class="nav-link" href="/students/1/specializations">اختبار التخصصات</a></li>
              <li class="nav-item"><a class="nav-link" href="#">نتائج المفاضلة</a></li>
             
            </ul>
          </div>
        </div>
      </nav>

    <!-- محتوى الصفحة -->
    <div class="container mt-4">
        @yield('content') 
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.sidebar-link').on('click', function() {
                $('.sidebar-link').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
</body>
</html>