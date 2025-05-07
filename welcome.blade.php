<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>نظام القبول والمفاضلة</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <style>
    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f8fc;
      line-height: 1.7;
    }

    .navbar {
      position: sticky;
      top: 0;
      z-index: 1000;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .hero-section {
      min-height: 65vh;
      background: linear-gradient(to right, #007bff, #0056b3);
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 60px 20px;
    }

    .hero-section h1 {
      font-size: 3rem;
      font-weight: bold;
    }

    .hero-section p {
      font-size: 1.25rem;
      max-width: 600px;
      margin: 20px auto;
    }

    .hero-section a.btn {
      font-size: 1.1rem;
      padding: 12px 28px;
      font-weight: 500;
    }

    .steps-progress {
    background: #f0f8ff;
    padding: 60px 20px;
  }

  .steps-wrapper {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 30px;
    position: relative;
    padding-top: 40px;
    overflow-x: auto;
  }

  .step {
    background: white;
    border-radius: 12px;
    padding: 20px;
    min-width: 250px;
    flex: 1;
    max-width: 280px;
    text-align: center;
    box-shadow: 0 8px 20px rgba(0, 123, 255, 0.15);
    transition: transform 0.3s ease;
    animation: fadeInUp 1s ease forwards;
    opacity: 0;
  }

  .step i {
    font-size: 2.5rem;
    color: #007bff;
    margin-bottom: 15px;
  }

  .step h5 {
    font-weight: bold;
    color: #007bff;
    margin-bottom: 10px;
  }

  .step p {
    font-size: 0.95rem;
    color: #333;
  }
  .registration-steps {
  background-color: #f8f9fa;
}

.step-box-wrapper {
  position: relative;
}

.step-box {
  background-color: #fff;
  padding: 20px 30px;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  position: relative;
}

.step-number-outside {
  position: absolute;
  right: 30px;
  top: 27px;
  width: 40px;
  height: 40px;
  background-color: #0d6efd;
  color: white;
  border-radius: 50%;
  font-weight: bold;
  text-align: center;
  line-height: 40px;
  font-size: 18px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  z-index: 1;
}

/* عنصر البريق */
.step-number-outside::after {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  width: 40px;
  height: 40px;
  background-color: rgba(13, 110, 253, 0.3); /* نفس لون الرقم بشفافية */
  border-radius: 50%;
  transform: translate(-50%, -50%);
  z-index: -1;
  animation: pulse-ring 2s infinite ease-out;
}

@keyframes pulse-ring {
  0% {
    transform: translate(-50%, -50%) scale(1);
    opacity: 0.6;
  }
  70% {
    transform: translate(-50%, -50%) scale(2.2);
    opacity: 0;
  }
  100% {
    transform: translate(-50%, -50%) scale(2.5);
    opacity: 0;
  }
}


  /* Animation */
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(40px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  .step:hover {
  background-color: rgba(13, 110, 253, 0.08); /* أزرق شفاف */
  transition: background-color 0.3s ease;
  cursor: pointer;
}.feature-box:hover {
  animation: shake 0.4s ease;
}

@keyframes shake {
  0% { transform: translateX(0); }
  20% { transform: translateX(-5px); }
  40% { transform: translateX(5px); }
  60% { transform: translateX(-5px); }
  80% { transform: translateX(5px); }
  100% { transform: translateX(0); }
}
/* انيميشن دخول من اليمين */
@keyframes fadeInRight {
  from {
    opacity: 0;
    transform: translateX(50px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

/* تطبيق الانيميشن */
.step {
  animation: fadeInRight 1s ease forwards;
  opacity: 0;
  margin-bottom: 40px; /* تباعد بين الخطوات */
  transition: background-color 0.3s ease;
}

/* تأخير الانيميشن لكل خطوة */
.step:nth-child(1) { animation-delay: 0.3s; }
.step:nth-child(2) { animation-delay: 0.6s; }
.step:nth-child(3) { animation-delay: 0.9s; }
.step:nth-child(4) { animation-delay: 1.2s; }

/* تأثير hover بلون أزرق شفاف */
.registration-step:hover {
  background-color: rgba(13, 110, 253, 0.08);
  cursor: pointer;
}

  /* Delay animation for each step */
  .step:nth-child(1) { animation-delay: 0.2s; }
  .step:nth-child(2) { animation-delay: 0.4s; }
  .step:nth-child(3) { animation-delay: 0.6s; }
  .step:nth-child(4) { animation-delay: 0.8s; }
  .features-section {
      padding: 40px 20px;
      text-align: center;
    }
    .feature-box {
      border: 1px solid #ddd;
      padding: 20px;
      border-radius: 8px;
      background-color: white;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      margin: 15px auto;
      width: 80%; /* لضبط العرض */
    }
    .feature-box h5 {
      color: #007bff;
      margin-bottom: 10px;
    }
    .footer {
      background-color: #343a40;
      color: #ffffff;
      padding: 20px 0;
      text-align: center;
    }
    .registration-steps {
  background-color: #f8f9fa;
}

  </style>
</head>
<body>

  <!-- شريط التنقل -->
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
          <li class="nav-item"><a class="nav-link" href="#">اختبار التخصصات</a></li>
          <li class="nav-item"><a class="nav-link" href="#">نتائج المفاضلة</a></li>
         
        </ul>
      </div>
    </div>
  </nav>

  <!-- القسم الرئيسي -->
  <section class="hero-section">
    <h1>مرحبًا بك في نظام المفاضلة الجامعية</h1>
    <p>ابدأ رحلتك التعليمية معنا من خلال خطوات تسجيل سهلة وفعالة</p>
    <a href="{{ route('students.create') }}" class="btn btn-light shadow-sm">ابدأ التسجيل</a>
  </section>

 
 <!-- قسم الميزات -->
<section class="features-section steps-progress">
  <div class="container">
    <h2 class="text-center text-primary mb-5">ميزات النظام</h2>
    <div class="steps-wrapper">
      <div class="step">
        <i class="bi bi-bell-fill"></i>
        <h5>إشعارات فورية</h5>
        <p>النظام يوفر إشعارات شاملة عبر البريد الإلكتروني لإبقاء الطلاب على اطلاع بحالة طلباتهم.</p>
      </div>
      <div class="step">
        <i class="bi bi-shield-check"></i>
        <h5>مفاضلة عادلة وشفافة</h5>
        <p>النظام يعتمد على آلية مقارنة واضحة لضمان العدالة والشفافية.</p>
      </div>
      <div class="step">
        <i class="bi bi-lightning-charge"></i>
        <h5>تسجيل سهل وسريع</h5>
        <p>عملية تسجيل سهلة تمكن الطلاب من تقديم طلباتهم بسرعة ومرونة.</p>
      </div>
    </div>
  </div>
</section>


  <!-- step for register -->
  <section class="registration-steps py-5">
    <div class="container">
      <h2 class="text-center fw-bold mb-5">خطوات التسجيل</h2>
  
      <div class="step-box-wrapper registration-step position-relative mb-5">
        <div class="step-number-outside">1</div>
        <div class="step-box text-end">
          <h5 class="fw-bold">تسجيل البيانات الشخصية والدرجات</h5>
          <p class="mb-0">قم بإدخال بياناتك الشخصية ودرجاتك في المواد المطلوبة بشكل دقيق</p>
        </div>
      </div>
  
      <div class="step-box-wrapper registration-step  position-relative mb-5">
        <div class="step-number-outside">2</div>
        <div class="step-box text-end">
          <h5 class="fw-bold">اختيار التخصصات المفضلة</h5>
          <p class="mb-0">اختر التخصصات التي ترغب بالالتحاق بها حسب الأولوية، يمكنك اختيار حتى 10 تخصصات</p>
        </div>
      </div>
  
      <div class="step-box-wrapper registration-step  position-relative mb-5">
        <div class="step-number-outside">3</div>
        <div class="step-box text-end">
          <h5 class="fw-bold">تأكيد طلب التسجيل</h5>
          <p class="mb-0">بعد مراجعة بياناتك واختياراتك، قم بتأكيد الطلب لإرساله للمفاضلة</p>
        </div>
      </div>
  
      <div class="step-box-wrapper registration-step  position-relative mb-5">
        <div class="step-number-outside">4</div>
        <div class="step-box text-end">
          <h5 class="fw-bold">استلام نتيجة المفاضلة</h5>
          <p class="mb-0">بعد إغلاق فترة التسجيل، سيتم إجراء المفاضلة وإعلان النتائج وإرسال إشعار لك</p>
        </div>
      </div>
  
    </div>
  </section>
  
  
  <!-- التذييل -->
  <footer class="footer">
    <div class="container">
      <p>جميع الحقوق محفوظة &copy; {{ date('Y') }} - نظام القبول والمفاضلة الجامعي</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
