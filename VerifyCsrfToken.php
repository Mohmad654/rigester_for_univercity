<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;

class VerifyCsrfToken
{
    /**
     * التعامل مع الطلب وتطبيق حماية CSRF.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // إضافة استثناء لبعض الـ URIs إذا لزم الأمر
        // إذا كنت بحاجة لاستثناء بعض المسارات من التحقق
        $except = [
            // '/some-excepted-route', // مثال على استثناء مسار
        ];

        // إذا كانت الصفحة ليست في الاستثناءات، تحقق من CSRF
        if (!in_array($request->path(), $except) && !$request->isMethod('GET')) {
            // التحقق من CSRF token
            if (!$request->has('_token') || !$this->tokensMatch($request)) {
                // إذا كان التحقق خاطئًا، إعادة توجيه المستخدم أو إظهار رسالة خطأ
                throw new TokenMismatchException;
            }
        }

        return $next($request);
    }

    /**
     * التحقق من تطابق الـ CSRF token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function tokensMatch($request)
    {
        // مقارنة التوكن
        return $request->input('_token') === $request->session()->token();
    }
}
